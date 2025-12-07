<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Collection;

class DashboardMetrics
{
    public function buildStats(int $userId): array
    {
        $totalProducts = Product::where('user_id', $userId)->count();
        $availableProducts = Product::where('user_id', $userId)
            ->where('is_available', true)
            ->count();

        $soldFromOrders = Order::where('user_id', $userId)->sum('quantity');
        // Hitung jumlah produk terjual dari transaksi (jumlah transaksi)
        $soldFromTransactions = Transaction::where('user_id', $userId)->count();
        $soldProducts = $soldFromOrders + $soldFromTransactions;

        $totalValue = Product::where('user_id', $userId)
            ->where('is_available', true)
            ->sum('price');

        return [
            'total_products'     => $totalProducts,
            'available_products' => $availableProducts,
            'sold_products'      => $soldProducts,
            'total_value'        => $totalValue,
        ];
    }

    public function buildSalesChartData(int $userId, string $range): Collection
    {
        $ordersQuery = Order::where('user_id', $userId);
        $transactionsQuery = Transaction::where('user_id', $userId);

        $data = collect();

        if ($range === 'monthly') {
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
