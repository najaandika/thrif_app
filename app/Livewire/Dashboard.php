<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Order;
use App\Services\DashboardMetrics;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public string $salesRange = 'weekly';

    protected DashboardMetrics $metrics;

    public function __construct()
    {
        $this->metrics = app(DashboardMetrics::class);
    }

    public function render()
    {
        $stats = $this->metrics->buildStats();

        $recent_products = Product::latest()
            ->take(5)
            ->get();

        $recent_orders = Order::with(['items.product'])
            ->latest()
            ->take(4)
            ->get();

        // Sales data for chart based on selected range
        $chart_data = $this->metrics->buildSalesChartData($this->salesRange);
        $chart_max = $chart_data->max() ?: 1; // Prevent division by zero

        return view('livewire.dashboard', [
            'stats' => $stats,
            'recent_products' => $recent_products,
            'recent_orders' => $recent_orders,
            'chart_data' => $chart_data,
            'chart_max' => $chart_max,
            'salesRange' => $this->salesRange,
        ]);
    }
}
