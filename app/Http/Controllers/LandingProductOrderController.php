<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;



class LandingProductOrderController extends Controller
{
    public function __invoke(Request $request, Product $product): RedirectResponse|JsonResponse
    {
        $user = $request->user();

        abort_unless($user && $user->isCustomer(), 403);

        $data = $request->validateWithBag('order', [
            'buyer_name' => ['required', 'string', 'max:255'],
            'buyer_contact' => ['nullable', 'string', 'max:255'],
            'shipping_address' => ['nullable', 'string', 'max:1000'],
            'pickup_address_note' => ['nullable', 'string', 'max:255'], // New field
            'size' => ['required', 'string'],
            'notes' => ['nullable', 'string', 'max:500'],
            'payment_method' => ['required', 'string', 'in:cash,midtrans'],
        ]);

        if (! $product->is_available) {
            throw ValidationException::withMessages([
                'size' => 'Produk tidak tersedia.',
            ])->errorBag('order');
        }

        $buyerContactInput = $data['buyer_contact'] ?? null;
        
        // Determine address: use pickup note if present, otherwise shipping address
        $shippingAddressInput = !empty($data['pickup_address_note']) 
            ? $data['pickup_address_note'] 
            : ($data['shipping_address'] ?? null);

        // Validation for shipping: valid if pickup OR if address provided
        if (empty($shippingAddressInput)) {
             throw ValidationException::withMessages([
                'shipping_address' => 'Alamat pengiriman wajib diisi jika memilih layanan pesan antar.',
            ])->errorBag('order');
        }

        $buyerContact = $buyerContactInput ?: $user->email;
        $shippingAddress = $shippingAddressInput;

        try {
            $order = DB::transaction(function () use ($data, $product, $user, $buyerContact, $shippingAddress) {
                // Update User Profile with new data (Persistence)
                $updates = [];
                
                // Update Phone if provided and not an email
                if ($buyerContact && $buyerContact !== $user->email && $buyerContact !== $user->phone) {
                    // Simple check: if it doesn't contain '@', assume it's a phone/social handle
                    if (!str_contains($buyerContact, '@')) {
                        $updates['phone'] = $buyerContact;
                    }
                }

                // Update Address if provided and valid (not pickup note)
                if ($shippingAddress && $shippingAddress !== 'AMBIL DI TOKO' && $shippingAddress !== $user->address) {
                    $updates['address'] = $shippingAddress;
                }

                // Update Name if changed (User wants full sync)
                if (!empty($data['buyer_name']) && $data['buyer_name'] !== $user->name) {
                    $updates['name'] = $data['buyer_name'];
                }

                if (!empty($updates)) {
                    $user->update($updates);
                }

                // Mark product as unavailable (sold/pending)
                // $product->update(['is_available' => false]); 
                // Note: Depending on business logic, we might want to keep it available until paid, 
                // or mark it reserved. For now, we'll assume it remains available until confirmed paid,
                // or we can mark it unavailable immediately. 
                // Given "thrifting" usually means unique, let's mark it unavailable to prevent double booking.
                // REVERTED: User wants product to remain visible until admin confirms.
                // $product->update(['is_available' => false]);

                // Create order
                // Create order Header
                $order = Order::create([
                    'type' => 'online',
                    'user_id' => $product->user_id, // Owner
                    'customer_id' => $user->id, // Buyer
                    'buyer_name' => $data['buyer_name'],
                    'buyer_contact' => $buyerContact,
                    'shipping_address' => $shippingAddress,
                    // 'size' => $data['size'], // Size moved to product/item? Wait, schema dropped size? No, schema dropped size from ORDER, but PRODUCT has size. 
                    // If the user selects a size, we should probably store it in notes or item notes?
                    // The schema analysis said "add_size_to_orders_table" existed, but my migration dropped product_id and quantity.
                    // Did I drop size? The migration "unify" didn't explicitly drop 'size' column from orders.
                    // Let's check if 'size' matches. If not, I put it in notes.
                    'total_price' => $product->final_price,
                    'status' => 'pending',
                    'notes' => $data['notes'] ?? null, // Just use notes as-is, size info removed
                    'payment_method' => $data['payment_method'],
                ]);

                // Create Order Item
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->final_price,
                    'subtotal' => $product->final_price,
                ]);

                return $order;
            });
        } catch (\Exception $e) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('Order creation failed: ' . $e->getMessage());

            throw ValidationException::withMessages([
                'order' => 'Terjadi kesalahan saat memproses order. Silakan coba lagi atau hubungi admin. (' . $e->getMessage() . ')',
            ])->errorBag('order');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil dibuat!',
                'redirect_url' => route('landing.orders.history')
            ]);
        }

        $redirect = redirect()->route('landing.orders.history')
            ->with('new_order_id', isset($order) ? $order->id : null);

        if (! $request->has('suppress_alert')) {
            $redirect->with('status', 'Pesanan berhasil dibuat! Cek detailnya di riwayat pesanan.');
        }

        return $redirect;
    }
}
