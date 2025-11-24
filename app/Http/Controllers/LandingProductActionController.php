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
            ->where('stock', '>', 0)
            ->findOrFail($validated['product_id']);

        $quantity = min($validated['quantity'], $product->stock);

        if ($validated['action'] === 'cart') {
            // Reuse simple session-based cart logic
            $cartItems = $request->session()->get('cart_items', []);
            $currentQty = $cartItems[$product->id]['quantity'] ?? 0;
            $newQty = min($currentQty + $quantity, $product->stock);

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

        // For checkout, store the desired quantity in session and redirect
        $request->session()->put('landing_checkout', [
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        return redirect()->route('landing.products.checkout', $product);
    }
}
