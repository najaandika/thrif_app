<?php

namespace App\Livewire;

use App\Models\Product;
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
        $userId = Auth::id();

        $stats = $this->metrics->buildStats($userId);

        $recent_products = Product::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // Sales data for chart based on selected range
        $chart_data = $this->metrics->buildSalesChartData($userId, $this->salesRange);

        return view('livewire.dashboard', [
            'stats' => $stats,
            'recent_products' => $recent_products,
            'chart_data' => $chart_data,
            'salesRange' => $this->salesRange,
        ]);
    }

}
