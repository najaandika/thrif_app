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

        // Get first address (since there's no user relationship)


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

        // CSS classes for reusability
        $inputClass = 'w-full rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-900 dark:text-gray-100 transition-all duration-300 focus:border-slate-900 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-900/20 dark:focus:ring-slate-500/20 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none';
        $labelClass = 'text-[11px] font-semibold tracking-[0.2em] text-gray-500 dark:text-gray-400 uppercase';

        return view('landing.checkout', [
            'product' => $product,
            'snapToken' => $snapToken,
            'user' => $user,
            'inputClass' => $inputClass,
            'labelClass' => $labelClass,
            'prefilledQuantity' => $quantity,
            'subtotal' => $grossAmount,
            'shopName' => \App\Models\Setting::get('shop_name', 'Thrif Studio'),
            'shopAddress' => \App\Models\Setting::get('shop_address', 'Alamat belum diatur'),
            'prefill' => [
                'buyer_name' => old('buyer_name', $user->name),
                'buyer_contact' => old('buyer_contact', $user->email),
                'shipping_address' => old('shipping_address'),
                'quantity' => $quantity,
                'notes' => old('notes'),
            ],
        ]);
    }
}
