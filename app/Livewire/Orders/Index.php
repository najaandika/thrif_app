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
    public $status = 'all';
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
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function delete($id): void
    {
        $order = Order::findOrFail($id);

        DB::transaction(function () use ($order) {
            if ($this->shouldAffectStock($order->status) && $order->product) {
                $product = $order->product;
                $product->increment('stock', $order->quantity);
                if ($product->stock > 0 && ! $product->is_available) {
                    $product->is_available = true;
                }
                $product->save();
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
        $order = Order::findOrFail($id);
        if ($order->status === 'pending') {
            $order->status = 'paid';
            $order->save();
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
            ->latest()
            ->paginate(10);

        return view('livewire.orders.index', [
            'orders' => $orders,
            'statusOptions' => $this->statusOptions(),
        ]);
    }

    public function statusOptions(): array
    {
        return [
            'pending' => 'Pending',
            'paid' => 'Paid',
            'shipped' => 'Shipped',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];
    }
}
