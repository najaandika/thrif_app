<?php
namespace App\Livewire\Pos;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
class Index extends Component
{
    protected $listeners = ['productSelected' => 'addToCart'];
    public $search = '';
    public $cart = [];
    public $cartQty = [];
    public $payment_method = 'cash';
    public $amount_received = 0;
    public $discount = 0;
    public $discountType = 'fixed'; // 'fixed' or 'percent'
    public $loadProducts = false;

    public function getProductsProperty()
    {
        if (! $this->loadProducts) {
            return collect();
        }

        return \App\Models\Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('id')
            ->limit(100)
            ->get();
    }

    public function toggleBrowse()
    {
        $this->loadProducts = ! $this->loadProducts;
    }

    #[Computed]
    public function total()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        if ($this->discountType === 'percent') {
            $discountAmount = $total * ((float) $this->discount / 100);
        } else {
            $discountAmount = (float) $this->discount;
        }

        return max($total - $discountAmount, 0);
    }

    #[Computed]
    public function change()
    {
        return max((float) $this->amount_received - $this->total(), 0);
    }

    public function addToCart($productId)
    {
        $product = \App\Models\Product::find($productId);
        if (!$product) return;

        foreach ($this->cart as $i => $item) {
            if ($item['id'] == $product->id) {
                $this->cart[$i]['qty']++;
                $this->cartQty[$product->id] = $this->cart[$i]['qty'];
                return;
            }
        }

        $this->cart[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => 1,
        ];
        $this->cartQty[$product->id] = 1;
    }

    public function removeFromCart($productId)
    {
        foreach ($this->cart as $i => $item) {
            if ($item['id'] == $productId) {
                array_splice($this->cart, $i, 1);
                unset($this->cartQty[$productId]);
                return;
            }
        }
    }

    public function updatedCartQty($value, $key)
    {
        if (isset($this->cartQty[$key])) {
            foreach ($this->cart as $i => $item) {
                if ($item['id'] == $key) {
                    $this->cart[$i]['qty'] = max(1, (int) $this->cartQty[$key]);
                    break;
                }
            }
        }
    }

    public function updatedDiscountType()
    {
        $this->discount = 0;
        $this->dispatch('reset-discount');
    }

    public function saveTransaction()
    {
        if (count($this->cart) == 0) {
            session()->flash('error', 'Keranjang kosong!');
            return;
        }

            DB::beginTransaction();
            try {
                // hitung total quantity dan subtotal dari cart
            $totalQty = 0;
            $subtotal = 0;
            foreach ($this->cart as $item) {
                $totalQty += (int) ($item['qty'] ?? 0);
                $subtotal += $item['price'] * $item['qty'];
            }

            // Hitung nilai diskon
            if ($this->discountType === 'percent') {
                $discountAmount = $subtotal * ((float) $this->discount / 100);
            } else {
                $discountAmount = (float) $this->discount;
            }

            // Simpan ke tabel transactions (terpisah dari orders)
            $transaction = \App\Models\Transaction::create([
                'user_id' => Auth::id(),
                'total_qty' => $totalQty,
                'total_price' => $this->total, // Ini sudah harga setelah diskon
                'discount' => $discountAmount,
                'payment_method' => $this->payment_method,
                'payment_status' => 'paid',
                'paid_at' => now(),
                'notes' => null,
            ]);

            foreach ($this->cart as $item) {
                \App\Models\TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'subtotal' => $item['price'] * $item['qty'],
                ]);

                // Kurangi stok produk
                $product = \App\Models\Product::find($item['id']);
                if ($product) {
                    $product->decrement('stock', $item['qty']);
                }
            }

            DB::commit();

            $this->cart = [];
            $this->cartQty = [];
            $this->amount_received = 0;
            $this->discount = 0;
            $this->discountType = 'fixed';
            $this->payment_method = 'cash';

            $this->dispatch('transaction-completed');

            session()->flash('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pos.index', [
            'products' => $this->products,
            'cart' => $this->cart,
            'cartQty' => $this->cartQty,
            'total' => $this->total,
            'change' => $this->change,
            'payment_method' => $this->payment_method,
            'amount_received' => $this->amount_received,
            'discount' => $this->discount,
        ]);
    }
}

