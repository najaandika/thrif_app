<div class="py-12">
    <div class="flex flex-row gap-6">
        <x-sidebar />
        
        <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-6xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <!-- Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">POS (Kasir Offline)</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola transaksi penjualan offline</p>
                    </div>

                    @if (session()->has('success'))
                        <div class="mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/40 dark:to-emerald-900/40 text-green-700 dark:text-green-200 border-l-4 border-green-500 shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif
                    
                    @if (session()->has('error'))
                        <div class="mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/40 dark:to-pink-900/40 text-red-700 dark:text-red-200 border-l-4 border-red-500 shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <form wire:submit.prevent="saveTransaction" class="space-y-6">
                        <!-- Pencarian Produk -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Cari Produk</label>
                            <div class="flex gap-3 items-center">
                                <div class="flex-1">
                                    <livewire:product-selector />
                                </div>
                                <button wire:click="toggleBrowse" type="button" class="inline-flex items-center px-4 py-2.5 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                    Browse
                                </button>
                            </div>
                        </div>

                        <!-- Daftar Produk -->
                        @if($loadProducts)
                            <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">Daftar Produk</h2>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Produk</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stok</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-32">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                            @forelse ($products as $product)
                                                <tr class="hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                                    <td class="px-6 py-4">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $product->name }}</div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="text-sm text-gray-900 dark:text-gray-100">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $product->stock > 10 ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-200' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-200') }}">
                                                            {{ $product->stock }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 text-right">
                                                        <button type="button" wire:click="addToCart({{ $product->id }})" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-xs font-semibold rounded-lg shadow-md hover:from-indigo-600 hover:to-purple-600 hover:shadow-lg transition-all duration-200 hover:scale-105">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                            </svg>
                                                            Tambah
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                        </svg>
                                                        <p class="mt-2">Produk tidak ditemukan.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <!-- Keranjang Transaksi -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h2 class="text-base font-semibold text-gray-900 dark:text-white">Keranjang</h2>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Produk</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-32">Qty</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Subtotal</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-32">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($cart as $item)
                                            <tr class="hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item['name'] }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <input type="number" min="1" wire:model.lazy="cartQty.{{ $item['id'] }}" class="w-20 px-3 py-2 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900 dark:text-gray-100">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <button type="button" wire:click="removeFromCart({{ $item['id'] }})" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-semibold rounded-lg hover:from-red-600 hover:to-pink-600 shadow-md hover:shadow-lg transition-all duration-200 hover:scale-105">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                    <p class="mt-2">Keranjang kosong.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Detail Pembayaran -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm space-y-6">
                            <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Detail Pembayaran</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Metode Pembayaran</label>
                                    <select id="payment_method" wire:model="payment_method" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-sm">
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="ewallet">Qris</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="amount_received" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Uang Diterima</label>
                                    <input type="number" id="amount_received" wire:model="amount_received" min="0" placeholder="0" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-sm">
                                </div>
                            </div>

                            <div>
                                <label for="discount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Diskon (Rp)</label>
                                <input type="number" id="discount" wire:model="discount" min="0" placeholder="0" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-sm">
                            </div>

                            <!-- Total Section -->
                            <div class="pt-6 border-t-2 border-gray-200 dark:border-gray-700 space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">Total:</span>
                                    <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl">
                                    <span class="text-base font-semibold text-gray-700 dark:text-gray-300">Kembalian:</span>
                                    <span class="text-lg font-bold text-green-600 dark:text-green-400">Rp {{ number_format($change, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-gray-200 dark:border-gray-700">
                            <button type="submit" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-bold text-base text-white uppercase tracking-wider hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100" @if(count($cart) == 0) disabled @endif>
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
