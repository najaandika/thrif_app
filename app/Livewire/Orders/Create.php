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
class Create extends Component
{
    public $product_id;
    public $buyer_name;
    public $buyer_contact;
    public $shipping_address;
    public $quantity = 1;
    public $status = 'pending';
    public $payment_method = 'cash';
    public $payment_status = 'unpaid';
    public $notes;

    protected function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'buyer_name' => 'required|string|max:255',
            'buyer_contact' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            // Status dan status pembayaran diset otomatis pada create
            'payment_method' => 'required|in:cash,transfer,e-wallet,cod',
            'notes' => 'nullable|string',
        ];
    }


    public function save()
    {
        $data = $this->validate();

        $product = Product::where('user_id', Auth::id())
            ->where('id', $data['product_id'])
            ->firstOrFail();

        if ($product->stock < $data['quantity']) {
            throw ValidationException::withMessages([
                'quantity' => 'Stok produk tidak mencukupi.',
            ]);
        }

        DB::transaction(function () use ($data, $product) {
            $orderStatus = 'pending';
            $paymentStatus = 'unpaid';

            if ($this->shouldAffectStock($orderStatus)) {
                $product->decrement('stock', $data['quantity']);
                if ($product->stock <= 0) {
                    $product->is_available = false;
                }
                $product->save();
            }

            Order::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'buyer_name' => $data['buyer_name'],
                'buyer_contact' => $data['buyer_contact'],
                'shipping_address' => $data['shipping_address'],
                'quantity' => $data['quantity'],
                'total_price' => $product->price * $data['quantity'],
                'status' => $orderStatus,
                'payment_method' => $data['payment_method'],
                'payment_status' => $paymentStatus,
                'paid_at' => null,
                'notes' => $data['notes'],
            ]);
        });

        session()->flash('message', 'Order baru berhasil dibuat.');
        return redirect()->route('orders.index');
    }

    protected function shouldAffectStock(string $status): bool
    {
        return in_array($status, ['pending', 'paid', 'shipped', 'completed'], true);
    }

    public function render()
    {
        return view('livewire.orders.create', [
            'products' => Product::where('user_id', Auth::id())
                ->where('stock', '>', 0)
                ->orderBy('name')
                ->get(),
            'paymentMethodOptions' => $this->paymentMethodOptions(),
        ]);
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

}
