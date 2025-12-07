<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use App\Models\CustomerAddress;

class LandingProductOrderController extends Controller
{
    public function __invoke(Request $request, Product $product): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user && $user->isCustomer(), 403);

        $data = $request->validateWithBag('order', [
            'buyer_name' => ['required', 'string', 'max:255'],
            'buyer_contact' => ['nullable', 'string', 'max:255'],
            'shipping_address' => ['nullable', 'string', 'max:1000'],
            'size' => ['required', 'string'],
            'notes' => ['nullable', 'string', 'max:500'],
            'payment_method' => ['required', 'string', 'in:cash,transfer,midtrans'],
        ]);

        if (! $product->is_available) {
            throw ValidationException::withMessages([
                'size' => 'Produk tidak tersedia.',
            ])->errorBag('order');
        }

        // Get saved address for fallback
        $savedAddress = CustomerAddress::first();

        $buyerContactInput = $data['buyer_contact'] ?? null;
        $shippingAddressInput = $data['shipping_address'] ?? null;

        $buyerContact = $buyerContactInput ?: ($savedAddress?->phone ?: $user->email);
        $shippingAddress = $shippingAddressInput ?: $savedAddress?->address_line;

        try {
            DB::transaction(function () use ($data, $product, $user, $buyerContact, $shippingAddress) {
                // Mark product as unavailable (sold/pending)
                // $product->update(['is_available' => false]); 
                // Note: Depending on business logic, we might want to keep it available until paid, 
                // or mark it reserved. For now, we'll assume it remains available until confirmed paid,
                // or we can mark it unavailable immediately. 
                // Given "thrifting" usually means unique, let's mark it unavailable to prevent double booking.
                // REVERTED: User wants product to remain visible until admin confirms.
                // $product->update(['is_available' => false]);

                // Create order
                Order::create([
                    'user_id' => $product->user_id,
                    'customer_id' => $user->id,
                    'product_id' => $product->id,
                    'buyer_name' => $data['buyer_name'],
                    'buyer_contact' => $buyerContact,
                    'shipping_address' => $shippingAddress,
                    'size' => $data['size'],
                    'quantity' => 1, // Always 1 for unique items
                    'total_price' => $product->price,
                    'status' => 'pending',
                    'notes' => $data['notes'] ?? null,
                    'payment_method' => $data['payment_method'],
                ]);
            });
        } catch (\Exception $e) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('Order creation failed: ' . $e->getMessage());

            throw ValidationException::withMessages([
                'order' => 'Terjadi kesalahan saat memproses order. Silakan coba lagi atau hubungi admin. (' . $e->getMessage() . ')',
            ])->errorBag('order');
        }

        return redirect()
            ->route('landing.orders.history')
            ->with('status', 'Order berhasil dikirim. Kamu bisa melihat detailnya di sini.');
    }
}
