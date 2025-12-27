<?php
namespace App\Livewire\Pos;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

#[Layout('layouts.app')]
class Index extends Component
{
    protected $listeners = ['productSelected' => 'addToCart'];
    public $search = '';
    public $cart = [];
    public $cartQty = [];
    public $payment_method = 'cash';
    public $amount_received = 0;
    public $loadProducts = true;
    public $showModal = false;
    public $selectedOrder;

    public function showLastReceipt($orderId)
    {
        $this->selectedOrder = \App\Models\Order::find($orderId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }

    public function getProductsProperty()
    {
        if (! $this->loadProducts) {
            return collect();
        }

        return \App\Models\Product::query()
            ->where('is_available', true)
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('category', 'like', '%' . $this->search . '%')
                      ->orWhere('condition', 'like', '%' . $this->search . '%');
                });
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
    public function total()
    {
        return $this->subtotal();
    }

    #[Computed]
    public function change()
    {
        return max((float) $this->amount_received - $this->total(), 0);
    }

    #[Computed]
    public function receiptConfig()
    {
        if (!$this->selectedOrder) {
            return null;
        }

        $order = $this->selectedOrder;
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
            'price' => $product->final_price,
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

    public function saveTransaction()
    {
        if (count($this->cart) == 0) {
            session()->flash('error', 'Keranjang kosong!');
            return;
        }

            DB::beginTransaction();
            try {
                // Simpan ke tabel orders (Unified)
            $order = \App\Models\Order::create([
                'type' => 'pos',
                'user_id' => Auth::id(), // Cashier
                'buyer_name' => 'Pelanggan Umum', // Default for POS
                'total_price' => $this->total,
                'discount' => 0, // No manual discount in POS
                'payment_method' => $this->payment_method,
                'payment_status' => 'paid',
                'status' => 'paid',
                'paid_at' => now(),
                'amount_received' => (float) $this->amount_received,
            ]);

            foreach ($this->cart as $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    // 'product_name' => $item['name'], // Not in schema, relying on relation
                    'price' => $item['price'],
                    'quantity' => $item['qty'],
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
            $this->payment_method = 'cash';

            $this->dispatch('transaction-completed');

            // Dispatch event with status message for SweetAlert, passing orderId for printing
            $this->dispatch('show-pos-success', message: 'Transaksi berhasil disimpan! ' . $order->invoice_number, orderId: $order->id);
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
        ]);
    }
}

