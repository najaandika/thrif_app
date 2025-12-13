@if($showModal && $selectedOrder)
<div 
    x-data='receiptModal(@json($this->receiptConfig))'
    class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto px-4 py-6 sm:px-0"
    style="display: flex;" 
>
    <!-- Backdrop -->
    <div wire:click="closeModal" class="fixed inset-0 transform transition-all" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-900/75 backdrop-blur-sm"></div>
    </div>

    <!-- Modal Panel -->
    <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-sm mx-auto overflow-hidden transition-all transform" 
         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        
        <!-- Close Button -->
        <button wire:click="closeModal" aria-label="Tutup" class="absolute top-4 right-4 z-20 p-2 rounded-full bg-gray-100 dark:bg-gray-700/80 text-gray-500 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors focus:outline-none">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Scrollable Content -->
        <div class="p-6 overflow-y-auto max-h-[80vh]">
            
            <!-- Receipt Content Area -->
            <div id="receipt-content" class="bg-white p-4 border border-gray-100 rounded-sm">
                
                <!-- Header -->
                <div class="text-center mb-6">
                    @if(\App\Models\Setting::get('shop_logo'))
                        <img src="{{ Storage::url(\App\Models\Setting::get('shop_logo')) }}" alt="Shop Logo" class="h-16 mx-auto mb-2 object-contain">
                    @endif
                    
                    <h2 class="text-xl font-bold text-gray-900 tracking-tight">{{ \App\Models\Setting::get('shop_name') ?? 'Thrif Studio' }}</h2>
                    <p class="text-xs text-gray-500 mt-1 px-4">{{ \App\Models\Setting::get('shop_address') ?? 'Jl. Contoh No. 123, Kota Demo' }}</p>
                    <p class="text-xs text-gray-500">{{ \App\Models\Setting::get('shop_phone') ?? '0812-3456-7890' }}</p>
                </div>

                <div class="border-b-2 border-dashed border-gray-300 mb-4"></div>

                <!-- Order Info -->
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-gray-500">No. Invoice</span>
                    <span class="font-mono font-medium text-gray-900">{{ $selectedOrder->invoice_number }}</span>
                </div>
                <div class="flex justify-between text-xs mb-4">
                    <span class="text-gray-500">Tanggal</span>
                    <span class="font-medium text-gray-900">{{ $selectedOrder->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <!-- Items -->
                <div class="space-y-3 mb-4">
                    @foreach($selectedOrder->items as $item)
                    <div class="text-sm">
                        <div class="font-medium text-gray-900">{{ $item->product->name ?? 'Produk dihapus' }}</div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</span>
                            <span class="font-medium text-gray-900">{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="border-b-2 border-dashed border-gray-300 mb-4"></div>

                <!-- Totals -->
                <div class="space-y-1 mb-6">
                <!-- Totals -->
                <div class="space-y-1 mb-6">
                     <!-- POS Details -->
                    @if($selectedOrder->type === 'pos')
                        
                        @if($selectedOrder->discount > 0)
                            @php
                                $subtotal = $selectedOrder->total_price + $selectedOrder->discount;
                                $percentage = $subtotal > 0 ? round(($selectedOrder->discount / $subtotal) * 100) : 0;
                            @endphp
                        <div class="flex justify-between text-xs text-gray-500 pt-1">
                            <span>Subtotal</span>
                            <span>{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-xs text-red-500 pt-1">
                            <span>Diskon ({{ $percentage }}%)</span>
                            <span>- {{ number_format($selectedOrder->discount, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        <!-- Total -->
                        <div class="flex justify-between text-sm font-bold text-gray-900 pt-1">
                            <span>TOTAL</span>
                            <span class="text-gray-900">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</span>
                        </div>

                        <!-- Payment -->
                        @if($selectedOrder->type === 'pos')
                        <div class="flex justify-between text-xs text-gray-500 pt-2">
                            <span>Uang Diterima</span>
                            <span>{{ number_format($selectedOrder->amount_received, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 pt-1">
                            <span>Kembalian</span>
                            <span>{{ number_format($selectedOrder->amount_received - $selectedOrder->total_price, 0, ',', '.') }}</span>
                        </div>
                        @endif

                    @else
                        <!-- Online Orders Logic -->
                        <!-- Online Only Logic -->
                         <div class="flex justify-between text-sm font-bold text-gray-900 pt-1">
                            <span>TOTAL</span>
                            <span class="text-gray-900">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</span>
                        </div>
                        
                        @if($selectedOrder->type !== 'pos')
                        <div class="flex justify-between text-xs text-gray-500 pt-2">
                            <span>Nama</span>
                            <span class="font-medium text-gray-900">{{ $selectedOrder->buyer_name }}</span>
                        </div>
                        @endif

                        <div class="flex justify-between text-xs text-gray-500 pt-2">
                            <span>Pengiriman</span>
                            <span>{{ $selectedOrder->shipping_address === 'AMBIL DI TOKO' ? 'Ambil di Toko' : 'Pesan Antar' }}</span>
                        </div>
                    @endif
                    
                    @if($selectedOrder->type !== 'pos')
                    <div class="flex justify-between text-xs text-gray-500 pt-2">
                        <span>Metode Bayar</span>
                        <span>
                            @if($selectedOrder->payment_method === 'cash')
                                @if($selectedOrder->shipping_address === 'AMBIL DI TOKO')
                                    Bayar di Kasir
                                @else
                                    COD
                                @endif
                            @else
                                {{ ucfirst($selectedOrder->payment_method ?? 'Non-Tunai') }}
                            @endif
                        </span>
                    </div>
                    @endif
                    
                    @if($selectedOrder->type !== 'pos')
                    <div class="flex justify-between text-xs text-gray-500 pt-1">
                        <span>Kontak</span>
                        <span class="font-medium text-gray-900">{{ $selectedOrder->buyer_contact ?? '-' }}</span>
                    </div>
                    @endif

                    @if($selectedOrder->shipping_address && $selectedOrder->type !== 'pos')
                    <div class="flex justify-between text-xs text-gray-500 pt-1 text-right">
                        <span class="shrink-0">Alamat</span>
                        <span class="font-medium text-gray-900 ml-4">
                            @if($selectedOrder->shipping_address === 'AMBIL DI TOKO')
                                {{ \App\Models\Setting::get('shop_address') ?? 'Alamat Toko' }}
                            @else
                                {{ $selectedOrder->shipping_address }}
                            @endif
                        </span>
                    </div>
                    @endif

                    @if($selectedOrder->notes)
                    <div class="flex justify-between text-xs text-gray-500 pt-1 text-right">
                        <span class="shrink-0">Catatan</span>
                        <span class="font-medium text-gray-900 ml-4 italic">"{{ $selectedOrder->notes }}"</span>
                    </div>
                    @endif

                    @if($selectedOrder->type !== 'pos')
                    <div class="flex justify-between text-xs text-gray-500 pt-1">
                        <span>Status</span>
                        <span class="font-bold {{ $selectedOrder->status === 'paid' ? 'text-emerald-600' : ($selectedOrder->status === 'pending' ? 'text-amber-600' : 'text-gray-600') }}">
                            {{ strtoupper($selectedOrder->status_label ?? $selectedOrder->status) }}
                        </span>
                    </div>
                    @endif
                </div>

                 <!-- Footer -->
                <div class="text-center text-xs text-gray-400 mt-8">
                    <p>Terima kasih sudah berbelanja!</p>
                    <p>Simpan struk ini sebagai bukti pembayaran.</p>
                </div>

            </div>
        </div>

        <!-- Footer Actions -->
        <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-col gap-3">
            <div class="grid grid-cols-2 gap-3">
                <button 
                    @click="printReceipt()" 
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none transition-all"
                >
                    <svg class="mr-2 -ml-1 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print
                </button>
                <button 
                    @click="shareToWa()" 
                    class="inline-flex items-center justify-center rounded-xl border border-transparent bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 focus:outline-none transition-all"
                >
                    <svg class="mr-2 -ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                       <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.008-.57-.008-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Kirim WA
                </button>
            </div>
            
            <button 
                @click="downloadReceipt()" 
                :disabled="downloading"
                class="w-full inline-flex items-center justify-center rounded-xl border border-transparent bg-slate-900 px-4 py-3 text-sm font-bold text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-wait transition-all"
            >
                <svg x-show="downloading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" style="display: none;">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Download Struk (JPG)</span>
            </button>
        </div>
    </div>
</div>
@endif


