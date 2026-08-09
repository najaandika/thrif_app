<?php

namespace App\Livewire\Reports;

use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        $paidQuery = Order::whereIn('status', ['paid', 'shipped', 'completed']);

        return view('livewire.reports.index', [
            'todayRevenue' => (clone $paidQuery)->whereDate('created_at', today())->sum('total_price'),
            'monthRevenue' => (clone $paidQuery)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total_price'),
            'paidOrders' => (clone $paidQuery)->count(),
            'readyProducts' => Product::where('is_available', true)->count(),
        ]);
    }
}
