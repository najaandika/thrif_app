<?php

namespace App\Livewire\Customers;

use App\Models\Order;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        $customers = User::query()
            ->where('role', User::ROLE_CUSTOMER)
            ->latest()
            ->take(12)
            ->get();

        return view('livewire.customers.index', [
            'customers' => $customers,
            'totalCustomers' => User::where('role', User::ROLE_CUSTOMER)->count(),
            'onlineOrders' => Order::where('type', 'online')->count(),
        ]);
    }
}
