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
            ->where('stock', '>', 0)
            ->findOrFail($validated['product_id']);

        $cartItems = $request->session()->get('cart_items', []);
        $currentQty = $cartItems[$product->id]['quantity'] ?? 0;

        // Batasi qty di keranjang agar tidak melebihi stok
        $newQty = min($currentQty + 1, $product->stock);

        $cartItems[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $newQty,
        ];

        $request->session()->put('cart_items', $cartItems);

        $cartCount = collect($cartItems)->sum('quantity');
        $request->session()->put('cart_count', $cartCount);

        return back()->with('message', 'Produk ditambahkan ke keranjang.');
    }
}
