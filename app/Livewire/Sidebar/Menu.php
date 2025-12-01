<?php

namespace App\Livewire\Sidebar;

use Livewire\Component;
use App\Models\Order;

class Menu extends Component
{
    public function getPendingOrdersCountProperty(): int
    {
        return Order::where('status', 'pending')->count();
    }

    public function render()
    {
        return view('livewire.sidebar.menu');
    }
}
