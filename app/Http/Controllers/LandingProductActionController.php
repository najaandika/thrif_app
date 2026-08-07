<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LandingProductActionController extends Controller
{
    public function handle(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'action' => ['required', 'in:cart,checkout'],
        ]);

        $product = Product::query()
            ->where('is_available', true)
            ->findOrFail($validated['product_id']);

        $quantity = 1;

        if ($validated['action'] === 'cart') {
            $cartItems = $request->session()->get('cart_items', []);
            $currentQty = $cartItems[$product->id]['quantity'] ?? 0;
            $newQty = $currentQty + $quantity;

            if ($newQty > 1) {
                return back()->with('error', 'Produk ini hanya tersedia 1 stok (Thrift).');
            }

            $cartItems[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->final_price,
                'original_price' => $product->price,
                'is_on_sale' => $product->is_on_sale,
                'discount_percent' => $product->discount_percent,
                'size' => $product->size,
                'quantity' => $newQty,
            ];

            $request->session()->put('cart_items', $cartItems);
            $cartCount = collect($cartItems)->sum('quantity');
            $request->session()->put('cart_count', $cartCount);

            return back()->with('message', 'Produk ditambahkan ke keranjang.');
        }

        $request->session()->put('landing_checkout', [
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        return redirect()->route('landing.products.checkout', $product);
    }
}
