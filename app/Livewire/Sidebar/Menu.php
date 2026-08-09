<?php

namespace App\Livewire\Sidebar;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;

class Menu extends Component
{
    public bool $mobile = false;

    public function getPendingOrdersCountProperty(): int
    {
        return Order::where('status', 'pending')->count();
    }

    public function getReadyProductsCountProperty(): int
    {
        return Product::where('is_available', true)->count();
    }

    public function render()
    {
        return view('livewire.sidebar.menu');
    }
}
