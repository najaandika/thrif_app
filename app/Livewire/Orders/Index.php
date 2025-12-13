<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Setting;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $status = 'all'; // status order (pending, paid, ...)
    public $orderType = 'all'; // filter tipe order (pos/online)
    protected $listeners = ['delete'];
    public $selectedOrder;
    public $showModal = false;

    public function viewOrder($id)
    {
        $this->selectedOrder = Order::with(['items.product', 'customer'])->findOrFail($id);
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
        'orderType' => ['except' => 'all'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingOrderType(): void
    {
        $this->resetPage();
    }

    public function delete($id): void
    {
        $order = Order::with('items.product')->findOrFail($id);

        DB::transaction(function () use ($order) {
            // Only restore product availability if order was confirmed (paid/shipped/completed)
            if (in_array($order->status, ['paid', 'shipped', 'completed'])) {
                foreach ($order->items as $item) {
                    if ($item->product && !$item->product->is_available) {
                        $item->product->is_available = true;
                        $item->product->save();
                    }
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
        $order = Order::with('items.product')->findOrFail($id);
        if ($order->status === 'pending') {
            DB::transaction(function () use ($order) {
                $order->status = 'paid';
                $order->payment_status = 'paid';
                $order->paid_at = now();
                $order->save();
                
                // Mark product as sold when order is confirmed
                foreach ($order->items as $item) {
                    if ($item->product && $item->product->is_available) {
                        $item->product->is_available = false;
                        $item->product->save();
                    }
                }
            });
            
            session()->flash('message', 'Order berhasil dikonfirmasi!');
        }
    }

    #[Computed]
    public function receiptConfig()
    {
        if (!$this->selectedOrder) {
            return null;
        }

        $order = $this->selectedOrder;
        $whatsappMessage = '';
        $itemsList = '';

        foreach ($order->items as $item) {
            $productName = $item->product->name ?? "Item";
            $itemsList .= "• $productName (x{$item->quantity})\n";
        }

        $shopName = strtoupper(Setting::get("shop_name") ?? "THRIF STUDIO");
        $invoice = $order->invoice_number ?? "-";
        $date = optional($order->created_at)->format("d/m/Y H:i") ?? "-";
        $total = number_format($order->total_price ?? 0, 0, ",", ".");
        
        $whatsappMessage = "*STRUK DIGITAL - $shopName*\n" .
                          "--------------------------------\n" .
                          "No. Invoice: $invoice\n" .
                          "Tanggal: $date\n\n" .
                          "*Detail Belanja:*\n" .
                          $itemsList;

        if (($order->discount ?? 0) > 0) {
            $discount = number_format($order->discount, 0, ",", ".");
            $whatsappMessage .= "\nDiskon: - Rp $discount";
        }

        $whatsappMessage .= "\n--------------------------------\n" .
                           "*TOTAL: Rp $total*\n" .
                           "--------------------------------\n" .
                           "Terima kasih sudah berbelanja!";

        return [
            'phone' => $order->buyer_contact ?? "",
            'message' => $whatsappMessage,
            'invoiceNumber' => $order->invoice_number ?? "INV"
        ];
    }

    public function render()
    {
        $orders = Order::with(['items.product', 'customer'])
            ->where('user_id', Auth::id())
            ->when($this->search, function ($query) {
                $term = '%' . $this->search . '%';
                $query->where(function ($subQuery) use ($term) {
                    $subQuery->where('buyer_name', 'like', $term)
                        ->orWhere('buyer_contact', 'like', $term)
                        ->orWhereHas('items.product', function ($productQuery) use ($term) {
                             $productQuery->where('name', 'like', $term);
                        });
                });
            })
            ->when($this->status !== 'all', fn ($query) => $query->where('status', $this->status))
            ->when($this->orderType !== 'all', fn ($query) => $query->where('type', $this->orderType))
            ->latest()
            ->paginate(10);

        return view('livewire.orders.index', [
            'orders' => $orders,
        ]);
    }
}
