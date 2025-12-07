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
            ->where('is_available', true)
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
    public function subtotal()
    {
        $subtotal = 0;
        foreach ($this->cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }
        return $subtotal;
    }

    #[Computed]
    public function discountAmount()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $discountValue = $this->discount === null || $this->discount === '' ? 0 : $this->discount;
        
        if ($this->discountType === 'percent') {
            return $total * ((float) $discountValue / 100);
        }
        
        return (float) $discountValue;
    }

    #[Computed]
    public function total()
    {
        $subtotal = $this->subtotal();
        return max($subtotal - $this->discountAmount(), 0);
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

        // Cek apakah produk sudah ada di keranjang, jika sudah jangan tambahkan lagi
        foreach ($this->cart as $item) {
            if ($item['id'] == $product->id) {
                return; // Sudah ada, tidak perlu tambah lagi
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
            $subtotal = 0;
            foreach ($this->cart as $item) {
                $subtotal += $item['price'] * $item['qty'];
            }

            // Hitung nilai diskon
            $discountValue = $this->discount === null || $this->discount === '' ? 0 : $this->discount;
            if ($this->discountType === 'percent') {
                $discountAmount = $subtotal * ((float) $discountValue / 100);
            } else {
                $discountAmount = (float) $discountValue;
            }

            // Simpan ke tabel transactions (terpisah dari orders)
            $transaction = \App\Models\Transaction::create([
                'user_id' => Auth::id(),
                'total_price' => $this->total, // Ini sudah harga setelah diskon
                'discount' => $discountAmount,
                'payment_method' => $this->payment_method,
                'payment_status' => 'paid',
                'paid_at' => now(),
                'amount_received' => (float) $this->amount_received,
            ]);

            foreach ($this->cart as $item) {
                \App\Models\TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'subtotal' => $item['price'] * $item['qty'],
                ]);

                // Set produk sold (is_available = false) setelah transaksi
                $product = \App\Models\Product::find($item['id']);
                if ($product) {
                    $product->is_available = false;
                    $product->save();
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

