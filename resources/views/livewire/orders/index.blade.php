<div class="py-12" wire:poll.5s>
    <div>
        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900 dark:to-emerald-900 text-green-700 dark:text-green-200 rounded-xl border-l-4 border-green-500 shadow-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        <div class="flex flex-row gap-6">
            <x-sidebar />

            <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-8">
                        <div class="mb-6 flex flex-col lg:flex-row gap-4 lg:items-center justify-between">
                            <div class="flex flex-col sm:flex-row gap-4 flex-1">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input wire:model.live="search" id="order_search" name="order_search" type="text" placeholder="Cari order..." class="w-full pl-12 pr-4 py-3 border border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                </div>
                                <div class="w-auto">
                                    <select wire:model.live="paymentMethod" id="order_payment" name="order_payment" class="pl-4 pr-11 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 appearance-none bg-no-repeat bg-[length:0.75em] bg-[right_1rem_center]" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke=%27%236b7280%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27M19 9l-7 7-7-7%27/%3E%3C/svg%3E');">
                                        <option value="all">Semua</option>
                                        <option value="cash">Cash On Delivery</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="midtrans">Midtrans</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full lg:w-auto">
                                <div class="flex flex-row gap-2">
                                    <form action="{{ route('orders.export.excel') }}" method="GET" class="inline-block">
                                        <input type="hidden" name="search" value="{{ $search }}">
                                        <input type="hidden" name="status" value="{{ $status }}">
                                        <button type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-semibold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h5M4 4h16v6l-4 10H8L4 10V4z" />
                                        </svg>
                                        Export Excel
                                        </button>
                                    </form>
                                    <form action="{{ route('orders.export.pdf') }}" method="GET" target="_blank" class="inline-block">
                                        <input type="hidden" name="search" value="{{ $search }}">
                                        <input type="hidden" name="status" value="{{ $status }}">
                                        <button type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-semibold rounded-xl text-white bg-rose-600 hover:bg-rose-700 shadow-sm hover:shadow-md transition-all">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h10a2 2 0 012 2v14l-5-3-5 3-5-3V5a2 2 0 012-2z" />
                                        </svg>
                                        Export PDF
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Produk</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pembeli</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Qty</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Update</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-32">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($orders as $order)
                                        <tr class="hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $order->product->name ?? '-' }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->quantity }} x Rp {{ number_format($order->product->price ?? 0, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $order->buyer_name }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->buyer_contact ?: '-' }}</div>
                                                <div class="text-xs text-gray-400 dark:text-gray-500 truncate max-w-[150px] mt-0.5" title="{{ $order->shipping_address }}">{{ $order->shipping_address ?: '-' }}</div>
                                                <div class="text-xs text-gray-900 dark:text-gray-100 font-medium mt-0.5">{{ $order->payment_method === 'cash' ? 'Cash On Delivery' : ucfirst($order->payment_method ?? '-') }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">{{ $order->quantity }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @php
                                                    $statusColors = [
                                                        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-200',
                                                        'paid' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200',
                                                        'shipped' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-200',
                                                        'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200',
                                                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-200',
                                                    ];
                                                @endphp
                                                <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">{{ ucfirst($order->status) }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $order->updated_at->diffForHumans() }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button type="button" wire:click="viewOrder({{ $order->id }})" class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-slate-600 to-slate-800 text-white text-xs font-semibold rounded-lg hover:from-slate-700 hover:to-slate-900 transition-all duration-200 shadow-md hover:shadow-lg hover:scale-105">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        Lihat
                                                    </button>
                                                    @if($order->status === 'pending')
                                                    <form wire:submit.prevent="confirmOrder({{ $order->id }})" class="inline-block">
                                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-emerald-500 to-green-500 text-white text-xs font-semibold rounded-lg hover:from-emerald-600 hover:to-green-600 transition-all duration-200 shadow-md hover:shadow-lg hover:scale-105">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Konfirmasi
                                                        </button>
                                                    </form>
                                                    @endif
                                                    <button type="button" onclick="confirmDelete({{ $order->id }})" class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-semibold rounded-lg hover:from-red-600 hover:to-pink-600 transition-all duration-200 shadow-md hover:shadow-lg hover:scale-105 relative z-10">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Belum ada order.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Detail Modal -->
    @if($showModal && $selectedOrder)
        <div class="modal-overlay" wire:click="closeModal">
            <div class="modal-container" wire:click.stop>
                <div class="modal-header">
                    <h3 class="modal-title">Detail Order #{{ str_pad($selectedOrder->id, 4, '0', STR_PAD_LEFT) }}</h3>
                    <button wire:click="closeModal" class="modal-close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Order Info -->
                    <div class="receipt-section">
                        <div class="receipt-row">
                            <span class="receipt-label">Tanggal:</span>
                            <span class="receipt-value">{{ $selectedOrder->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Status:</span>
                            <span class="status-badge {{ $selectedOrder->status === 'paid' ? 'status-paid' : ($selectedOrder->status === 'pending' ? 'status-unpaid' : 'status-badge-info') }}">
                                {{ ucfirst($selectedOrder->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Buyer Info -->
                    <div class="receipt-section">
                        <h4 class="receipt-section-title">Informasi Pembeli</h4>
                        <div class="receipt-row">
                            <span class="receipt-label">Nama:</span>
                            <span class="receipt-value">{{ $selectedOrder->buyer_name }}</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Kontak:</span>
                            <span class="receipt-value">{{ $selectedOrder->buyer_contact ?: '-' }}</span>
                        </div>
                        <div class="receipt-row items-start">
                            <span class="receipt-label pr-4">Alamat:</span>
                            <p class="receipt-value max-w-sm text-left leading-relaxed">
                                {{ $selectedOrder->shipping_address ?: '-' }}
                            </p>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Pembayaran:</span>
                            <span class="receipt-value">{{ $selectedOrder->payment_method === 'cash' ? 'Cash On Delivery' : ucfirst($selectedOrder->payment_method ?? '-') }}</span>
                        </div>
                    </div>

                    <!-- Items -->
                    <div class="receipt-section">
                        <h4 class="receipt-section-title">Item Produk</h4>
                        <div class="receipt-items">
                            <div class="receipt-item">
                                <div class="receipt-item-info">
                                    <div class="receipt-item-name">{{ $selectedOrder->product->name ?? 'Produk tidak tersedia' }}</div>
                                    <div class="receipt-item-detail">{{ $selectedOrder->quantity }} x Rp {{ number_format($selectedOrder->product->price ?? 0, 0, ',', '.') }}</div>
                                </div>
                                <div class="receipt-item-subtotal">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="receipt-section receipt-summary">
                        <div class="receipt-row">
                            <span class="receipt-label">Total Qty:</span>
                            <span class="receipt-value font-semibold">{{ $selectedOrder->quantity }}</span>
                        </div>
                        <div class="receipt-row receipt-total">
                            <span class="receipt-label">Total Harga:</span>
                            <span class="receipt-value">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button wire:click="closeModal" class="btn-close-modal">Tutup</button>
                </div>
            </div>
        </div>
    @endif
</div>
