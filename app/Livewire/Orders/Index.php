<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $status = 'all'; // status order (pending, paid, ...)
    public $paymentMethod = 'all'; // filter metode pembayaran
    protected $listeners = ['delete'];
    public $selectedOrder;
    public $showModal = false;

    public function viewOrder($id)
    {
        $this->selectedOrder = Order::with('product')->findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
        'paymentMethod' => ['except' => 'all'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingPaymentMethod(): void
    {
        $this->resetPage();
    }

    public function delete($id): void
    {
        $order = Order::findOrFail($id);

        DB::transaction(function () use ($order) {
            // Only restore product availability if order was confirmed (paid/shipped/completed)
            // Pending orders never marked the product as sold, so no need to restore
            if (in_array($order->status, ['paid', 'shipped', 'completed']) && $order->product) {
                $product = $order->product;
                if (!$product->is_available) {
                    $product->is_available = true;
                    $product->save();
                }
            }

            $order->delete();
        });

        session()->flash('message', 'Order berhasil dihapus.');
    }

    protected function shouldAffectStock(string $status): bool
    {
        return in_array($status, ['pending', 'paid', 'shipped', 'completed'], true);
    }

    public function confirmOrder($id)
    {
        $order = Order::with('product')->findOrFail($id);
        if ($order->status === 'pending') {
            DB::transaction(function () use ($order) {
                $order->status = 'paid';
                $order->payment_status = 'paid';
                $order->paid_at = now();
                $order->save();
                
                // Mark product as sold when order is confirmed
                if ($order->product && $order->product->is_available) {
                    $order->product->is_available = false;
                    $order->product->save();
                }
            });
            
            session()->flash('message', 'Order berhasil dikonfirmasi!');
        }
    }

    public function render()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->when($this->search, function ($query) {
                $term = '%' . $this->search . '%';
                $query->where(function ($subQuery) use ($term) {
                    $subQuery->where('buyer_name', 'like', $term)
                        ->orWhere('buyer_contact', 'like', $term)
                        ->orWhereHas('product', function ($productQuery) use ($term) {
                            $productQuery->where('name', 'like', $term);
                        });
                });
            })
            ->when($this->status !== 'all', fn ($query) => $query->where('status', $this->status))
            ->when($this->paymentMethod !== 'all', fn ($query) => $query->where('payment_method', $this->paymentMethod))
            ->latest()
            ->paginate(10);

        return view('livewire.orders.index', [
            'orders' => $orders,
        ]);
    }
}
