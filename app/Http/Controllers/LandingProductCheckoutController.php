<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LandingProductCheckoutController extends Controller
{
    public function __invoke(Request $request, Product $product): View
    {
        $user = $request->user();

        abort_unless($user && $user->isCustomer(), 403);

        $savedAddress = $user->address;

        return view('landing.checkout', [
            'product' => $product,
            'prefill' => [
                'buyer_name' => old('buyer_name', $user->name),
                'buyer_contact' => old('buyer_contact', $user->email),
                'shipping_address' => old('shipping_address', $savedAddress?->asTextarea()),
                'quantity' => old('quantity', 1),
                'notes' => old('notes'),
            ],
        ]);
    }
}
