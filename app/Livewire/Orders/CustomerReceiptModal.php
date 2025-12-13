<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

class CustomerReceiptModal extends Component
{
    public $showModal = false;
    public $order;

    protected $listeners = ['open-receipt-modal' => 'openModal'];

    public function openModal($orderId)
    {
        $this->order = Order::with('items.product')->find($orderId);
        
        if ($this->order) {
            $this->showModal = true;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->order = null;
    }

    public function render()
    {
        return view('livewire.orders.customer-receipt-modal');
    }
}
