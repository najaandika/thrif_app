<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Edit extends Component
{
    public Order $order;

    public $product_id;
    public $buyer_name;
    public $buyer_contact;
    public $shipping_address;
    public $quantity;
    public $status;
    public $payment_method;
    public $payment_status;
    public $notes;

    protected function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'buyer_name' => 'required|string|max:255',
            'buyer_contact' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,paid,shipped,completed,cancelled',
            'payment_method' => 'required|in:cash,transfer,e-wallet,cod',
            'payment_status' => 'required|in:unpaid,waiting_confirmation,paid,refunded',
            'notes' => 'nullable|string',
        ];
    }

    public function mount(Order $order): void
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $this->order = $order;
        $this->product_id = $order->product_id;
        $this->buyer_name = $order->buyer_name;
        $this->buyer_contact = $order->buyer_contact;
        $this->shipping_address = $order->shipping_address;
        $this->quantity = $order->quantity;
        $this->status = $order->status;
        $this->payment_method = $order->payment_method ?? 'cash';
        $this->payment_status = $order->payment_status ?? 'unpaid';
        $this->notes = $order->notes;
    }

    public function update()
    {
        $data = $this->validate();

        $newProduct = Product::where('user_id', Auth::id())
            ->where('id', $data['product_id'])
            ->firstOrFail();

        DB::transaction(function () use ($data, $newProduct) {
            // Kembalikan stok lama bila status sebelumnya memotong stok
            if ($this->shouldAffectStock($this->order->status) && $this->order->product) {
                $previousProduct = $this->order->product;
                $previousProduct->increment('stock', $this->order->quantity);
                if ($previousProduct->stock > 0 && ! $previousProduct->is_available) {
                    $previousProduct->is_available = true;
                }
                $previousProduct->save();
            }

            // Potong stok baru bila perlu
            if ($this->shouldAffectStock($data['status'])) {
                $newProduct->refresh();
                if ($newProduct->stock < $data['quantity']) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Stok produk tidak mencukupi.',
                    ]);
                }
                $newProduct->decrement('stock', $data['quantity']);
                if ($newProduct->stock <= 0) {
                    $newProduct->is_available = false;
                }
                $newProduct->save();
            }

            $this->order->update([
                'product_id' => $newProduct->id,
                'buyer_name' => $data['buyer_name'],
                'buyer_contact' => $data['buyer_contact'],
                'shipping_address' => $data['shipping_address'],
                'quantity' => $data['quantity'],
                'total_price' => $newProduct->price * $data['quantity'],
                'status' => $data['status'],
                'payment_method' => $data['payment_method'],
                'payment_status' => $data['payment_status'],
                'paid_at' => $data['payment_status'] === 'paid' ? now() : null,
                'notes' => $data['notes'],
            ]);
        });

        session()->flash('message', 'Order berhasil diperbarui.');
        return redirect()->route('orders.index');
    }

    protected function shouldAffectStock(string $status): bool
    {
        return in_array($status, ['pending', 'paid', 'shipped', 'completed'], true);
    }

    public function render()
    {
        return view('livewire.orders.edit', [
            'products' => Product::where('user_id', Auth::id())
                ->orderBy('name')
                ->get(),
            'statusOptions' => $this->statusOptions(),
            'paymentMethodOptions' => $this->paymentMethodOptions(),
            'paymentStatusOptions' => $this->paymentStatusOptions(),
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

    public function paymentMethodOptions(): array
    {
        return [
            'cash' => 'Tunai',
            'transfer' => 'Transfer Bank',
            'e-wallet' => 'E-Wallet',
            'cod' => 'Bayar di Tempat (COD)',
        ];
    }

    public function paymentStatusOptions(): array
    {
        return [
            'unpaid' => 'Belum Dibayar',
            'waiting_confirmation' => 'Menunggu Konfirmasi',
            'paid' => 'Sudah Dibayar',
            'refunded' => 'Dikembalikan',
        ];
    }
}
