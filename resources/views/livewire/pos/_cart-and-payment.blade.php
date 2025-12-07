<!-- Right Column: Cart + Payment -->
<div class="w-full lg:w-96 space-y-6">
    <!-- Keranjang Transaksi -->
    <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            <h2 class="text-sm font-semibold text-gray-900 dark:text-white">Keranjang</h2>
        </div>
        <div class="p-4 max-h-80 overflow-y-auto">
            @forelse ($cart as $item)
                <div class="flex items-center gap-3 py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                    <!-- Product Name & Qty -->
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item['name'] }}</p>
                        <!-- Hapus input quantity dan harga, hanya tampilkan nama produk -->
                    </div>
                    
                    <!-- Subtotal & Delete -->
                    <div class="flex flex-col items-end gap-1">
                        <p class="text-sm font-bold text-gray-900 dark:text-white whitespace-nowrap">
                            {{ rupiah($item['price'] * $item['qty']) }}
                        </p>
                        <button type="button" wire:click="removeFromCart({{ $item['id'] }})" class="text-red-500 hover:text-red-700 p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="py-8 text-center text-gray-400">
                    <svg class="mx-auto h-10 w-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="text-sm">Keranjang kosong</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Detail Pembayaran -->
    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm space-y-6">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Detail Pembayaran</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Metode Pembayaran</label>
                <select id="payment_method" name="payment_method" wire:model="payment_method" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-900 dark:focus:ring-gray-100 focus:border-transparent transition-all shadow-sm">
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    <option value="ewallet">Qris</option>
                </select>
            </div>
            <div>
                <label for="amount_received" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Uang Diterima</label>
                <div wire:ignore>
                    <input type="text" id="amount_received" name="amount_received" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-900 dark:focus:ring-gray-100 focus:border-transparent transition-all shadow-sm" placeholder="0">
                </div>
            </div>
        </div>

        <!-- Total Section -->
        <div class="pt-6 border-t-2 border-gray-200 dark:border-gray-700 space-y-3">
            <div class="flex justify-between items-center text-sm text-gray-600 dark:text-gray-400">
                <span class="font-medium">Subtotal</span>
                <span class="font-bold text-gray-900 dark:text-white">{{ rupiah($this->subtotal) }}</span>
            </div>

            <!-- Diskon Inline -->
            <div class="flex justify-between items-center text-sm">
                <label for="discount" class="font-medium text-gray-600 dark:text-gray-400">Diskon</label>
                <div class="flex items-center gap-2">
                    <select wire:model.live="discountType" class="py-1 pl-2 pr-6 border-gray-200 dark:border-gray-600 rounded-lg text-xs focus:ring-gray-900 focus:border-gray-900 dark:bg-gray-800 dark:text-gray-200">
                        <option value="fixed">Rp</option>
                        <option value="percent">%</option>
                    </select>
                    <input type="number" wire:model.live.debounce.500ms="discount" class="w-24 py-1 px-2 border-gray-200 dark:border-gray-600 rounded-lg text-xs text-right focus:ring-gray-900 focus:border-gray-900 dark:bg-gray-800 dark:text-gray-200" placeholder="0">
                </div>
            </div>

            <!-- Discount Amount Display -->
            @if($this->discountAmount > 0)
                <div class="flex justify-between items-center text-sm text-red-500">
                    <span class="font-medium">Potongan Diskon</span>
                    <span class="font-bold">- {{ rupiah($this->discountAmount) }}</span>
                </div>
            @endif

            <div class="flex justify-between items-center pt-3 border-t border-dashed border-gray-200 dark:border-gray-700">
                <span class="text-2xl font-bold text-gray-900 dark:text-white">Total:</span>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ rupiah($this->total()) }}</span>
            </div>
            <div class="flex justify-between items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl">
                <span class="text-base font-semibold text-gray-700 dark:text-gray-300">Kembalian:</span>
                <span class="text-lg font-bold text-green-600 dark:text-green-400">{{ rupiah($this->change()) }}</span>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-gray-200 dark:border-gray-700">
        <button type="submit" class="inline-flex items-center px-8 py-4 bg-gray-900 dark:bg-white border border-transparent rounded-xl font-bold text-base text-white dark:text-gray-900 uppercase tracking-wider hover:bg-black dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-900 dark:focus:ring-white focus:ring-offset-2 transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100" @if(count($cart) == 0) disabled @endif>
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Simpan Transaksi
        </button>
    </div>
</div>
