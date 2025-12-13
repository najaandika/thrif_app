<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

use Illuminate\Support\Collection;

class DashboardMetrics
{
    public function buildStats(int $userId): array
    {
        $totalProducts = Product::where('user_id', $userId)->count();
        $availableProducts = Product::where('user_id', $userId)
            ->where('is_available', true)
            ->count();

        // Calculate sold products using OrderItem via Order
        $soldProducts = \App\Models\OrderItem::whereHas('order', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->sum('quantity');

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

        $data = collect();

        if ($range === 'monthly') {
            $start = now()->subDays(29)->startOfDay();

            $sales = $ordersQuery
                ->where('created_at', '>=', $start)
                ->selectRaw('DATE(created_at) as period, SUM(total_price) as total')
                ->groupBy('period')
                ->pluck('total', 'period');

            for ($i = 29; $i >= 0; $i--) {
                $period = now()->subDays($i)->format('Y-m-d');
                $data->push($sales->get($period, 0));
            }
        } elseif ($range === 'yearly') {
            $start = now()->subMonths(11)->startOfMonth();

            $sales = $ordersQuery
                ->where('created_at', '>=', $start)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, SUM(total_price) as total')
                ->groupBy('period')
                ->pluck('total', 'period');

            for ($i = 11; $i >= 0; $i--) {
                $period = now()->subMonths($i)->format('Y-m');
                $data->push($sales->get($period, 0));
            }
        } else {
            $start = now()->subDays(6)->startOfDay();

            $sales = $ordersQuery
                ->where('created_at', '>=', $start)
                ->selectRaw('DATE(created_at) as period, SUM(total_price) as total')
                ->groupBy('period')
                ->pluck('total', 'period');

            for ($i = 6; $i >= 0; $i--) {
                $period = now()->subDays($i)->format('Y-m-d');
                $data->push($sales->get($period, 0));
            }
        }

        return $data;
    }
}
