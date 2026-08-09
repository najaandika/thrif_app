<?php

namespace App\Livewire\Transactions;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        $orders = Order::query()
            ->latest()
            ->take(12)
            ->get();

        return view('livewire.transactions.index', [
            'orders' => $orders,
            'paidTotal' => Order::where('payment_status', 'paid')->sum('total_price'),
            'pendingTotal' => Order::where('payment_status', '!=', 'paid')->count(),
        ]);
    }
}
