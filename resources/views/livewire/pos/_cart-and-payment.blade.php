<!-- Right Column: Cart + Payment -->
<div class="w-full lg:w-96 space-y-6">
    <!-- Keranjang Transaksi & Pembayaran Container -->
    <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col h-full">
        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            <h2 class="text-sm font-semibold text-gray-900 dark:text-white">Keranjang @if(count($cart) > 0)<span class="text-gray-500 font-normal">({{ count($cart) }})</span>@endif</h2>
        </div>
        
        <!-- Cart List -->
        <div class="p-4 max-h-80 overflow-y-auto border-b border-gray-100 dark:border-gray-700">
            @forelse ($cart as $item)
                <div class="flex items-center gap-3 py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                    <!-- Product Name -->
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item['name'] }}</p>
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

        <!-- Total & Payment Section -->
        <div class="p-4 space-y-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <!-- Subtotal -->
            <div class="flex justify-between items-center text-sm text-gray-600 dark:text-gray-400">
                <span class="font-medium">Subtotal</span>
                <span class="font-bold text-gray-900 dark:text-white">{{ rupiah($this->subtotal) }}</span>
            </div>

            <!-- Total -->
            <div class="flex justify-between items-center pt-3 border-t border-dashed border-gray-200 dark:border-gray-700">
                <span class="text-xl font-bold text-gray-900 dark:text-white">Total</span>
                <span class="text-xl font-bold text-gray-900 dark:text-white">{{ rupiah($this->total()) }}</span>
            </div>
            
            <!-- Payment Method -->
            <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between gap-3">
                    <label for="payment_method" class="text-xs font-medium text-gray-600 dark:text-gray-400">Pembayaran</label>
                    <select wire:model.live="payment_method" id="payment_method" name="payment_method" class="flex-1 max-w-[150px] py-1.5 px-3 rounded-lg border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm focus:ring-gray-900 focus:border-gray-900 dark:text-white">
                        <option value="cash">Tunai</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>
            </div>

            <!-- Uang Diterima - Only show for Cash -->
            @if($payment_method === 'cash')
                <div class="flex items-center justify-between gap-3">
                    <label for="amount_received" class="text-xs font-medium text-gray-600 dark:text-gray-400">Diterima</label>
                    <div class="relative flex-1 max-w-[150px]">
                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-xs">Rp</span>
                        </div>
                        <input 
                            type="text" 
                            x-data="currencyInput('{{ $amount_received }}', 'amount_received')"
                            x-on:input="update($event)"
                            :value="displayValue"
                            id="amount_received"
                            name="amount_received"
                            class="w-full pl-7 py-1.5 rounded-lg border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm text-right focus:ring-gray-900 focus:border-gray-900 dark:text-white" 
                            placeholder="0">
                    </div>
                </div>

                <!-- Kembalian -->
                <div class="flex justify-between items-center p-3 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-lg">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Kembalian</span>
                    <span class="text-base font-bold text-green-600 dark:text-green-400">{{ rupiah($this->change()) }}</span>
                </div>
            @endif
        </div>

        <!-- Submit Button Footer -->
        <div class="p-3 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gray-900 dark:bg-white border border-transparent rounded-lg font-semibold text-sm text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-900 dark:focus:ring-white focus:ring-offset-2 transition shadow-md disabled:opacity-50 disabled:cursor-not-allowed" @if(count($cart) == 0) disabled @endif>
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan
            </button>
        </div>
    </div>
</div>
