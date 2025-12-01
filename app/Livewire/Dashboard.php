<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public string $salesRange = 'weekly';

    public function render()
    {
        $userId = Auth::id();

        // Produk
        $totalProducts = Product::where('user_id', $userId)->count();
        $availableProducts = Product::where('user_id', $userId)
            ->where('is_available', true)
            ->count();

        // Total terjual dihitung dari pesanan + transaksi
        $soldFromOrders = Order::where('user_id', $userId)->sum('quantity');
        $soldFromTransactions = Transaction::where('user_id', $userId)->sum('total_qty');
        $soldProducts = $soldFromOrders + $soldFromTransactions;

        $totalValue = Product::where('user_id', $userId)
            ->where('is_available', true)
            ->sum('price');

        $stats = [
            'total_products'      => $totalProducts,
            'available_products'  => $availableProducts,
            'sold_products'       => $soldProducts,
            'total_value'         => $totalValue,
        ];

        $recent_products = Product::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // Sales data for chart based on selected range
        $chart_data = $this->buildSalesChartData($userId, $this->salesRange);

        return view('livewire.dashboard', [
            'stats' => $stats,
            'recent_products' => $recent_products,
            'chart_data' => $chart_data,
            'salesRange' => $this->salesRange,
        ]);
    }

    protected function buildSalesChartData(int $userId, string $range)
    {
        $ordersQuery = Order::where('user_id', $userId);
        $transactionsQuery = Transaction::where('user_id', $userId);

        $data = collect();

        if ($range === 'monthly') {
            // 30 hari terakhir (harian)
            $start = now()->subDays(29)->startOfDay();

            $orders = (clone $ordersQuery)
                ->where('created_at', '>=', $start)
                ->selectRaw('DATE(created_at) as period, SUM(total_price) as total')
                ->groupBy('period')
                ->pluck('total', 'period');

            $transactions = (clone $transactionsQuery)
                ->where('created_at', '>=', $start)
                ->selectRaw('DATE(created_at) as period, SUM(total_price) as total')
                ->groupBy('period')
                ->pluck('total', 'period');

            for ($i = 29; $i >= 0; $i--) {
                $period = now()->subDays($i)->format('Y-m-d');
                $data->push(($orders->get($period, 0)) + ($transactions->get($period, 0)));
            }
        } elseif ($range === 'yearly') {
            // 12 bulan terakhir (bulanan)
            $start = now()->subMonths(11)->startOfMonth();

            $orders = (clone $ordersQuery)
                ->where('created_at', '>=', $start)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, SUM(total_price) as total')
                ->groupBy('period')
                ->pluck('total', 'period');

            $transactions = (clone $transactionsQuery)
                ->where('created_at', '>=', $start)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, SUM(total_price) as total')
                ->groupBy('period')
                ->pluck('total', 'period');

            for ($i = 11; $i >= 0; $i--) {
                $period = now()->subMonths($i)->format('Y-m');
                $data->push(($orders->get($period, 0)) + ($transactions->get($period, 0)));
            }
        } else {
            // Weekly: 7 hari terakhir
            $start = now()->subDays(6)->startOfDay();

            $orders = (clone $ordersQuery)
                ->where('created_at', '>=', $start)
                ->selectRaw('DATE(created_at) as period, SUM(total_price) as total')
                ->groupBy('period')
                ->pluck('total', 'period');

            $transactions = (clone $transactionsQuery)
                ->where('created_at', '>=', $start)
                ->selectRaw('DATE(created_at) as period, SUM(total_price) as total')
                ->groupBy('period')
                ->pluck('total', 'period');

            for ($i = 6; $i >= 0; $i--) {
                $period = now()->subDays($i)->format('Y-m-d');
                $data->push(($orders->get($period, 0)) + ($transactions->get($period, 0)));
            }
        }

        return $data;
    }
}
