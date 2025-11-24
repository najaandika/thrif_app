<div class="py-12">
    <div>
        <div class="flex flex-col lg:flex-row gap-6">
            <x-sidebar />

            <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-6">
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-2">
                        <a href="{{ route('orders.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Orders</a>
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">Edit</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit Order #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update order information.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl border-l-4 border-indigo-500">
                    <!-- Card Header -->
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-50/50 to-purple-50/50 dark:from-indigo-900/20 dark:to-purple-900/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Order Information</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">Modify order and customer details</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <form wire:submit="update" id="orderForm">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Order #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h2>
                                    <a href="{{ route('orders.index') }}" class="text-sm text-indigo-600 dark:text-indigo-300 font-semibold hover:underline"></a>
                                </div>

                                <div>
                                    <label for="product_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Produk *</label>
                                    <select wire:model="product_id" id="product_id" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }} (stok: {{ $product->stock }})</option>
                                        @endforeach
                                    </select>
                                    @error('product_id') <span class="text-red-600 text-sm font-semibold">{{ $message }}</span> @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="buyer_name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Pembeli *</label>
                                        <input wire:model="buyer_name" type="text" id="buyer_name" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                        @error('buyer_name') <span class="text-red-600 text-sm font-semibold">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="buyer_contact" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Kontak</label>
                                        <input wire:model="buyer_contact" type="text" id="buyer_contact" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                        @error('buyer_contact') <span class="text-red-600 text-sm font-semibold">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="shipping_address" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Alamat Pengiriman</label>
                                    <textarea wire:model="shipping_address" id="shipping_address" rows="3" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"></textarea>
                                    @error('shipping_address') <span class="text-red-600 text-sm font-semibold">{{ $message }}</span> @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label for="quantity" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Jumlah *</label>
                                        <input wire:model="quantity" type="number" min="1" id="quantity" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                        @error('quantity') <span class="text-red-600 text-sm font-semibold">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                                        <select wire:model="status" id="status" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                            @foreach ($statusOptions as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('status') <span class="text-red-600 text-sm font-semibold">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="flex flex-col justify-end">
                                        @php
                                            $selectedProduct = $products->firstWhere('id', $product_id);
                                            $previewTotal = $selectedProduct ? $selectedProduct->price * max((int) $quantity, 1) : 0;
                                        @endphp
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Perkiraan total</p>
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($previewTotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="payment_method" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Metode Pembayaran *</label>
                                        <select wire:model="payment_method" id="payment_method" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                            @foreach ($paymentMethodOptions as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('payment_method') <span class="text-red-600 text-sm font-semibold">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="payment_status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Status Pembayaran *</label>
                                        <select wire:model="payment_status" id="payment_status" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                            @foreach ($paymentStatusOptions as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('payment_status') <span class="text-red-600 text-sm font-semibold">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Catatan</label>
                                    <textarea wire:model="notes" id="notes" rows="3" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"></textarea>
                                    @error('notes') <span class="text-red-600 text-sm font-semibold">{{ $message }}</span> @enderror
                                </div>

                            </div>
                        </form>
                    </div>

                    <!-- Card Footer -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end gap-3">
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                            Batal
                        </a>
                        <button type="submit" form="orderForm" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
