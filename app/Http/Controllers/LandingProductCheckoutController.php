<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Services\MidtransService;

class LandingProductCheckoutController extends Controller
{
    public function __invoke(Request $request, Product $product, MidtransService $midtrans): View
    {
        $user = $request->user();

        abort_unless($user && $user->isCustomer(), 403);

        $savedAddress = $user->address;

        $quantity = max(1, (int) old('quantity', 1));
        $grossAmount = $quantity * $product->price;

        $params = [
            'transaction_details' => [
                'order_id' => 'CHK-' . $product->id . '-' . time(),
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = $midtrans->createSnapToken($params);

        return view('landing.checkout', [
            'product' => $product,
            'snapToken' => $snapToken,
            'prefill' => [
                'buyer_name' => old('buyer_name', $user->name),
                'buyer_contact' => old('buyer_contact', $user->email),
                'shipping_address' => old('shipping_address', $savedAddress?->asTextarea()),
                'quantity' => $quantity,
                'notes' => old('notes'),
            ],
        ]);
    }
}
