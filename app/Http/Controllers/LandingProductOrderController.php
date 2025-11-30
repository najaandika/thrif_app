<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
            'quantity' => ['required', 'integer', 'min:1'],
            'size' => ['required', 'string'],
            'notes' => ['nullable', 'string', 'max:500'],
            'payment_method' => ['required', 'string', 'in:cash,transfer,midtrans'],
        ]);

        $variant = $product->sizes()->where('size', $data['size'])->first();

        if (! $variant) {
            throw ValidationException::withMessages([
                'size' => 'Ukuran tidak valid.',
            ])->errorBag('order');
        }

        if (! $product->is_available || $variant->stock < $data['quantity']) {
            throw ValidationException::withMessages([
                'quantity' => 'Stok produk untuk ukuran ini tidak mencukupi.',
            ])->errorBag('order');
        }

        $buyerContactInput = $data['buyer_contact'] ?? null;
        $shippingAddressInput = $data['shipping_address'] ?? null;

        $buyerContact = $buyerContactInput ?: ($user->address?->phone ?: $user->email);
        $shippingAddress = $shippingAddressInput ?: $user->address?->asTextarea();

        DB::transaction(function () use ($data, $product, $user, $buyerContact, $shippingAddress, $variant) {
            // Deduct stock from variant
            $variant->stock -= $data['quantity'];
            $variant->save();

            // Update main product stock
            $product->stock -= $data['quantity'];

            if ($product->stock <= 0) {
                $product->stock = 0;
                $product->is_available = false;
            }

            $product->save();

            Order::create([
                'user_id' => $product->user_id,
                'customer_id' => $user->id,
                'product_id' => $product->id,
                'buyer_name' => $data['buyer_name'],
                'buyer_contact' => $buyerContact,
                'shipping_address' => $shippingAddress,
                'quantity' => $data['quantity'],
                'size' => $data['size'],
                'total_price' => $product->price * $data['quantity'],
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
                'payment_method' => $data['payment_method'],
            ]);
        });

        return redirect()
            ->route('landing.orders.history')
            ->with('status', 'Order berhasil dikirim. Kamu bisa melihat detailnya di sini.');
    }
}
