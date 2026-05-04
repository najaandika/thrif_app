<div>
    <?php if($showModal && $order): ?>
    <div 
        x-data='receiptModal(<?php echo e(json_encode($this->receiptConfig)); ?>)'
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
                
                <!-- Receipt Content Area (Captured by html2canvas) -->
                <div id="receipt-content" class="bg-white p-4 border border-gray-100 rounded-sm">
                    
                    <!-- Header -->
                    <div class="text-center mb-6">
                        <?php if(\App\Models\Setting::get('shop_logo')): ?>
                            <img src="<?php echo e(Storage::url(\App\Models\Setting::get('shop_logo'))); ?>" alt="Shop Logo" class="h-16 mx-auto mb-2 object-contain">
                        <?php endif; ?>
                        
                        <h2 class="text-xl font-bold text-gray-900 tracking-tight"><?php echo e(\App\Models\Setting::get('shop_name') ?? 'Thrif Studio'); ?></h2>
                        <p class="text-xs text-gray-500 mt-1 px-4"><?php echo e(\App\Models\Setting::get('shop_address') ?? 'Jl. Contoh No. 123, Kota Demo'); ?></p>
                        <p class="text-xs text-gray-500"><?php echo e(\App\Models\Setting::get('shop_phone') ?? '0812-3456-7890'); ?></p>
                    </div>

                    <div class="border-b-2 border-dashed border-gray-300 mb-4"></div>

                    <!-- Order Info -->
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-500">No. Invoice</span>
                        <span class="font-mono font-medium text-gray-900"><?php echo e($order->invoice_number); ?></span>
                    </div>
                    <div class="flex justify-between text-xs mb-4">
                        <span class="text-gray-500">Tanggal</span>
                        <span class="font-medium text-gray-900"><?php echo e($order->created_at->format('d/m/Y H:i')); ?></span>
                    </div>

                    <!-- Items -->
                    <div class="space-y-3 mb-4">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $originalPrice = $item->product->price ?? $item->price;
                            $wasDiscounted = $originalPrice > $item->price;
                        ?>
                        <div class="text-sm">
                            <div class="flex items-start justify-between gap-2">
                                <div class="font-medium text-gray-900"><?php echo e($item->product->name); ?></div>
                                <?php if($wasDiscounted && $item->product->discount_percentage): ?>
                                    <span class="text-[10px] bg-red-100 text-red-600 px-1.5 py-0.5 rounded font-bold shrink-0">-<?php echo e(round($item->product->discount_percentage)); ?>%</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>
                                    <?php echo e($item->quantity); ?> x 
                                    <?php if($wasDiscounted): ?>
                                        <span class="line-through"><?php echo e(number_format($originalPrice, 0, ',', '.')); ?></span>
                                        <span class="text-red-500 font-medium"><?php echo e(number_format($item->price, 0, ',', '.')); ?></span>
                                    <?php else: ?>
                                        <?php echo e(number_format($item->price, 0, ',', '.')); ?>

                                    <?php endif; ?>
                                </span>
                                <span class="font-medium text-gray-900"><?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="border-b-2 border-dashed border-gray-300 mb-4"></div>

                    <!-- Totals -->
                    <div class="space-y-1 mb-6">
                         <div class="flex justify-between text-sm font-bold text-gray-900 pt-1">
                            <span>TOTAL</span>
                            <span class="text-gray-900">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></span>
                        </div>
                        
                        <div class="flex justify-between text-xs text-gray-500 pt-2">
                            <span>Pengiriman</span>
                            <span><?php echo e($order->shipping_address === 'AMBIL DI TOKO' ? 'Ambil di Toko' : 'Pesan Antar'); ?></span>
                        </div>
                        
                        <div class="flex justify-between text-xs text-gray-500 pt-2">
                            <span>Metode Bayar</span>
                            <span>
                                <?php if($order->payment_method === 'cash'): ?>
                                    <?php if($order->shipping_address === 'AMBIL DI TOKO'): ?>
                                        Bayar di Kasir
                                    <?php else: ?>
                                        COD
                                    <?php endif; ?>
                                <?php else: ?>
                                    Non-Tunai (Midtrans)
                                <?php endif; ?>
                            </span>
                        </div>
                        
                        <div class="flex justify-between text-xs text-gray-500 pt-1">
                            <span>Kontak</span>
                            <span class="font-medium text-gray-900"><?php echo e($order->buyer_contact ?? '-'); ?></span>
                        </div>

                        <div class="flex justify-between text-xs text-gray-500 pt-1 text-right">
                            <span class="shrink-0">Alamat</span>
                            <span class="font-medium text-gray-900 ml-4">
                                <?php if($order->shipping_address === 'AMBIL DI TOKO'): ?>
                                    <?php echo e(\App\Models\Setting::get('shop_address') ?? 'Alamat Toko'); ?>

                                <?php else: ?>
                                    <?php echo e($order->shipping_address); ?>

                                <?php endif; ?>
                            </span>
                        </div>

                        <?php if($order->notes): ?>
                        <div class="flex justify-between text-xs text-gray-500 pt-1 text-right">
                            <span class="shrink-0">Catatan</span>
                            <span class="font-medium text-gray-900 ml-4 italic">"<?php echo e($order->notes); ?>"</span>
                        </div>
                        <?php endif; ?>

                        <div class="flex justify-between text-xs text-gray-500 pt-1">
                            <span>Status</span>
                            <span class="font-bold <?php echo e($order->status === 'paid' ? 'text-emerald-600' : ($order->status === 'pending' ? 'text-amber-600' : 'text-gray-600')); ?>">
                                <?php echo e(strtoupper($order->status_label)); ?>

                            </span>
                        </div>
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
                <button 
                    @click="downloadReceipt()" 
                    :disabled="downloading"
                    class="w-full inline-flex items-center justify-center rounded-xl border border-transparent bg-slate-900 px-4 py-3 text-sm font-bold text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-wait transition-all"
                >
                    <svg x-show="!downloading" class="mr-2 -ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                     <svg x-show="downloading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" style="display: none;">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Download Struk (JPG)</span>
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\www\thrif\resources\views\livewire\orders\customer-receipt-modal.blade.php ENDPATH**/ ?>