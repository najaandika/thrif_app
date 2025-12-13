<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CustomerOrderHistoryController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        abort_unless($user && $user->isCustomer(), 403);

        $orders = Order::with('items.product')
            ->where(function ($query) use ($user) {
                $query->where('customer_id', $user->id)
                    ->orWhere('buyer_contact', $user->email);
            })
            ->latest()
            ->get();

        return view('landing.history', [
            'orders' => $orders,
            'customer' => $user,
        ]);
    }
}
