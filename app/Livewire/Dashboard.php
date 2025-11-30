<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_products' => Product::where('user_id', Auth::id())->count(),
            'available_products' => Product::where('user_id', Auth::id())->where('is_available', true)->count(),
            'sold_products' => Product::where('user_id', Auth::id())->where('is_available', false)->count(),
            'total_value' => Product::where('user_id', Auth::id())->where('is_available', true)->sum('price'),
        ];

        $recent_products = Product::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        // Weekly Sales Data from Orders
        $weekly_sales_orders = \App\Models\Order::where('user_id', Auth::id())
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->get()
            ->pluck('total', 'date');

        // Weekly Sales Data from Transactions
        $weekly_sales_transactions = \App\Models\Transaction::where('user_id', Auth::id())
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->get()
            ->pluck('total', 'date');

        $chart_data = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $orders_total = $weekly_sales_orders->get($date, 0);
            $transactions_total = $weekly_sales_transactions->get($date, 0);
            $chart_data->push($orders_total + $transactions_total);
        }

        return view('livewire.dashboard', [
            'stats' => $stats,
            'recent_products' => $recent_products,
            'chart_data' => $chart_data,
        ]);
    }
}
