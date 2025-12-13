<?php

namespace App\Livewire\Landing;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Services\MidtransService;

#[Layout('layouts.checkout')]
class Cart extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $buyerName;
    public $buyerContact;
    public $shippingAddress;
    public $paymentMethod = 'cash';
    public $notes;
    public $deliveryType = 'shipping'; // Default to shipping

    public function mount()
    {
        $this->loadCart();
        
        $user = Auth::user();
        if ($user) {
            $this->buyerName = $user->name;
            $this->buyerContact = $user->phone ?? $user->email;
            $this->shippingAddress = $user->address;
        }
    }

    public function loadCart()
    {
        $sessionItems = Session::get('cart_items', []);
        
        // Convert to array if it's not (though Session::get default is [])
        if (!is_array($sessionItems)) {
            $sessionItems = [];
        }

        foreach ($sessionItems as $key => $item) {
            if (isset($item['product_id'])) {
                $product = Product::with('images')->find($item['product_id']);
                if ($product) {
                    // Try main image first, then fallback to gallery images
                    $image = $product->image;
                    
                    if (!$image && $product->images->isNotEmpty()) {
                        $image = $product->images->first()->image_path;
                    }

                    $sessionItems[$key]['image'] = $image;
                    
                    // Add size if not already present
                    if (!isset($sessionItems[$key]['size'])) {
                        $sessionItems[$key]['size'] = $product->size;
                    }
                }
            }
        }

        $this->cartItems = $sessionItems;
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cartItems)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function removeFromCart($productId)
    {
        $cart = Session::get('cart_items', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart_items', $cart);
            $this->dispatch('cart-updated');
        }
        $this->loadCart();
    }

    public function checkout(MidtransService $midtrans)
    {
        $rules = [
            'buyerName' => 'required|string|max:255',
            'buyerContact' => 'required|string|max:255',
            'paymentMethod' => 'required|in:cash,midtrans',
            'deliveryType' => 'required|in:shipping,pickup',
        ];

        if ($this->deliveryType === 'shipping') {
            $rules['shippingAddress'] = 'required|string';
        }

        $this->validate($rules);

        if ($this->deliveryType === 'pickup') {
            $this->shippingAddress = 'Ambil di Toko';
        }

        if (empty($this->cartItems)) {
            session()->flash('error', 'Keranjang belanja kosong.');
            return;
        }

        // Handle Midtrans
        if ($this->paymentMethod === 'midtrans') {
            // Check stock but DO NOT create order yet
            foreach ($this->cartItems as $item) {
                $product = Product::find($item['product_id']);
                if (!$product || !$product->is_available) {
                    session()->flash('error', "Produk {$item['name']} sudah tidak tersedia.");
                    return;
                }
            }

            // Generate Token
            // Use a temporary ID that won't clash with DB IDs
            // We can't use Order ID because it doesn't exist. 
            // We use 'CART-' prefix.
            $tempId = 'CART-' . Auth::id() . '-' . time();
            
            $params = [
                'transaction_details' => [
                    'order_id' => $tempId,
                    'gross_amount' => (int) $this->total,
                ],
                'customer_details' => [
                    'first_name' => $this->buyerName,
                    'email' => Auth::user()->email, // Use Account Email for Midtrans Requirement
                    'phone' => is_numeric($this->buyerContact) ? $this->buyerContact : null, // Use input as phone if numeric
                ],
            ];

            try {
                $snapToken = $midtrans->createSnapToken($params);
                // Dispatch with orderId (tempId) although we won't use it for cancel anymore
                $this->dispatch('open-midtrans-payment', token: $snapToken, orderId: $tempId);
                return;
            } catch (\Exception $e) {
                session()->flash('error', 'Gagal memproses Midtrans: ' . $e->getMessage());
                return;
            }
        }

        // Handle Cash
        DB::beginTransaction();
        try {
            $order = $this->createOrder(); // Existing helper (need to ensure it's compatible)
            DB::commit();

            Session::forget('cart_items');
            Session::forget('cart_count');

            // Dispatch event for client-side alert and redirect
            $this->dispatch('show-cart-success', message: 'Pesanan berhasil dibuat! Cek detailnya di riwayat pesanan.');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    private function createOrder()
    {
         $user = Auth::user();

         // Persist User Changes
         if ($user) {
             $updates = [];
             
             // Update Phone
             if ($this->buyerContact && $this->buyerContact !== $user->email && $this->buyerContact !== $user->phone) {
                 if (!str_contains($this->buyerContact, '@')) {
                     $updates['phone'] = $this->buyerContact;
                 }
             }

             // Update Address
             if ($this->shippingAddress && $this->shippingAddress !== 'Ambil di Toko' && $this->shippingAddress !== $user->address) {
                 $updates['address'] = $this->shippingAddress;
             }

             // Update Name
             if ($this->buyerName && $this->buyerName !== $user->name) {
                 $updates['name'] = $this->buyerName;
             }

             if (!empty($updates)) {
                 $user->update($updates);
             }
         }

         $order = Order::create([
            'type' => 'online',
            'user_id' => 1,
            'customer_id' => Auth::id(),
            'buyer_name' => $this->buyerName,
            'buyer_contact' => $this->buyerContact,
            'shipping_address' => $this->shippingAddress,
            'total_price' => $this->total,
            'status' => 'pending', 
            // Note: If called from finalizePayment, we should probably update to 'paid' immediately
            // But this function sets 'pending'. We can update it later or pass status.
            'payment_method' => $this->paymentMethod,
            'notes' => $this->notes,
        ]);

        foreach ($this->cartItems as $item) {
            $product = Product::find($item['product_id']);
            if ($product) { // simplified check
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity'],
                ]);
            }
        }
        
        return $order;
    }

    public function render()
    {
        return view('livewire.landing.cart');
    }

    // Event handlers moved to Standard Controller (LandingCartController::finalize)
}
