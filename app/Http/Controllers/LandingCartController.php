<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LandingCartController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $product = Product::query()
            ->where('is_available', true)
            ->findOrFail($validated['product_id']);

        $cartItems = $request->session()->get('cart_items', []);
        $currentQty = $cartItems[$product->id]['quantity'] ?? 0;

        // Batasi qty di keranjang (misal max 1 untuk barang thrift unik)
        $newQty = $currentQty + 1; // Thrift usually unique, so maybe just 1? Or allow multiple? 
        // If unique, we should check if already exists. But for now let's just allow add.
        // Assuming unique thrift item means qty 1.
        if ($newQty > 1) {
             return back()->with('error', 'Produk ini hanya tersedia 1 stok (Thrift).');
        }

        $cartItems[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'size' => $product->size,
            'quantity' => $newQty,
        ];

        $request->session()->put('cart_items', $cartItems);

        $cartCount = collect($cartItems)->sum('quantity');
        $request->session()->put('cart_count', $cartCount);

        return back()->with('message', 'Produk ditambahkan ke keranjang.');
    }
    public function finalize(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user, 403);

        $cartItems = $request->session()->get('cart_items', []);
        
        if (empty($cartItems)) {
            return redirect()->route('landing.products.index')
                ->with('error', 'Keranjang kosong.');
        }

        // Validate basic requirement
        $validated = $request->validate([
            'buyer_name' => 'required|string',
            'buyer_contact' => 'required|string',
            'shipping_address' => 'required|string',
            'payment_result' => 'nullable|string', // JSON string from Snap
        ]);

        $paymentResult = $validated['payment_result'] ? json_decode($validated['payment_result'], true) : null;
        $total = collect($cartItems)->sum(function($item) {
             return $item['price'] * $item['quantity'];
        });

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            // Persist User Changes
            $updates = [];
            $buyerContact = $validated['buyer_contact'];
            $shippingAddress = $validated['shipping_address'];
            $buyerName = $validated['buyer_name'];

            // Update Phone
            if ($buyerContact && $buyerContact !== $user->email && $buyerContact !== $user->phone) {
                if (!str_contains($buyerContact, '@')) {
                    $updates['phone'] = $buyerContact;
                }
            }

            // Update Address
            if ($shippingAddress && $shippingAddress !== 'Ambil di Toko' && $shippingAddress !== 'AMBIL DI TOKO' && $shippingAddress !== $user->address) {
                $updates['address'] = $shippingAddress;
            }

            // Update Name
            if ($buyerName && $buyerName !== $user->name) {
                $updates['name'] = $buyerName;
            }

            if (!empty($updates)) {
                $user->update($updates);
            }

            // Create Order
            $order = \App\Models\Order::create([
                'type' => 'online',
                'user_id' => 1, // Default user
                'customer_id' => $user->id,
                'buyer_name' => $validated['buyer_name'],
                'buyer_contact' => $validated['buyer_contact'],
                'shipping_address' => $validated['shipping_address'],
                'total_price' => $total,
                'status' => 'pending', // Set to pending like Direct Checkout for admin notification
                'payment_method' => 'midtrans',
                'notes' => $request->input('notes'),
            ]);

            foreach ($cartItems as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    \App\Models\OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'subtotal' => $product->price * $item['quantity'],
                    ]);
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            // Clear Session
            $request->session()->forget('cart_items');
            $request->session()->forget('cart_count');

            $redirect = redirect()->route('landing.orders.history');
            
            if (! $request->has('suppress_alert')) {
                $redirect->with('status', 'Pembayaran Berhasil! Pesanan telah dibuat.');
            }

            return $redirect;

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }
}
