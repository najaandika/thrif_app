<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Setting;

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

    #[Computed]
    public function receiptConfig()
    {
        if (!$this->order) {
            return null;
        }

        return [
            'phone' => '', // Not needed for download only
            'message' => '', // Not needed for download only
            'invoiceNumber' => $this->order->invoice_number ?? "INV"
        ];
    }

    public function render()
    {
        return view('livewire.orders.customer-receipt-modal');
    }
}
