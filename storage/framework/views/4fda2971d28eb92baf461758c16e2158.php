<!--[if BLOCK]><![endif]--><?php if($showModal && $selectedOrder): ?>
    <div class="modal-overlay" wire:click="closeModal">
        <div class="modal-container" wire:click.stop>
            <div class="modal-header">
                <h3 class="modal-title">Detail Order</h3>
                <button wire:click="closeModal" class="modal-close">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <div class="receipt-section">
                    <div class="receipt-row">
                        <span class="receipt-label">No. Invoice:</span>
                        <span class="receipt-value font-mono font-bold"><?php echo e($selectedOrder->invoice_number); ?></span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Tanggal:</span>
                        <span class="receipt-value"><?php echo e($selectedOrder->created_at->format('d M Y, H:i')); ?></span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Status:</span>
                        <span class="status-badge <?php echo e($selectedOrder->status === 'paid' ? 'status-paid' : ($selectedOrder->status === 'pending' ? 'status-unpaid' : 'status-badge-info')); ?>">
                            <?php echo e(ucfirst($selectedOrder->status)); ?>

                        </span>
                    </div>
                </div>

                <div class="receipt-section">
                    <h4 class="receipt-section-title">Informasi Pembeli</h4>
                    <div class="receipt-row">
                        <span class="receipt-label">Nama:</span>
                        <span class="receipt-value"><?php echo e($selectedOrder->buyer_name); ?></span>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($selectedOrder->buyer_contact): ?>
                    <div class="receipt-row">
                        <span class="receipt-label">Kontak:</span>
                        <span class="receipt-value"><?php echo e($selectedOrder->buyer_contact); ?></span>
                    </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <!--[if BLOCK]><![endif]--><?php if($selectedOrder->shipping_address): ?>
                    <div class="receipt-row items-start">
                        <span class="receipt-label pr-4">Alamat:</span>
                        <p class="receipt-value max-w-sm text-left leading-relaxed">
                            <?php echo e($selectedOrder->shipping_address); ?>

                        </p>
                    </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <!--[if BLOCK]><![endif]--><?php if($selectedOrder->notes): ?>
                    <div class="receipt-row items-start">
                        <span class="receipt-label pr-4">Catatan:</span>
                        <p class="receipt-value max-w-sm text-left leading-relaxed italic text-gray-500">
                            <?php echo e($selectedOrder->notes); ?>

                        </p>
                    </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <div class="receipt-row">
                        <span class="receipt-label">Pembayaran:</span>
                        <span class="receipt-value">
                            <!--[if BLOCK]><![endif]--><?php if($selectedOrder->payment_method === 'cash'): ?>
                                <?php echo e($selectedOrder->type === 'pos' ? 'Tunai' : 'Cash On Delivery'); ?>

                            <?php else: ?>
                                <?php echo e(ucfirst($selectedOrder->payment_method ?? '-')); ?>

                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </span>
                    </div>
                </div>

                <div class="receipt-section">
                    <h4 class="receipt-section-title">Item Produk</h4>
                    <div class="receipt-items">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $selectedOrder->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="receipt-item">
                            <div class="receipt-item-info">
                                <div class="receipt-item-name"><?php echo e($item->product->name ?? 'Produk dihapus'); ?></div>
                                <div class="text-xs text-gray-500"><?php echo e($item->quantity); ?> x <?php echo e(rupiah($item->price)); ?></div>
                            </div>
                            <div class="receipt-item-price">
                                <?php echo e(rupiah($item->subtotal)); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <div class="receipt-section receipt-summary">
                    <!-- Total Qty dihapus -->
                    
                    <!--[if BLOCK]><![endif]--><?php if($selectedOrder->type === 'pos'): ?>
                        <!-- POS-specific fields -->
                        <!--[if BLOCK]><![endif]--><?php if($selectedOrder->discount > 0): ?>
                        <div class="receipt-row">
                            <span class="receipt-label">Diskon:</span>
                            <span class="receipt-value text-red-500">- <?php echo e(rupiah($selectedOrder->discount)); ?></span>
                        </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        
                        <div class="receipt-row receipt-total">
                            <span class="receipt-label">Total Harga:</span>
                            <span class="receipt-value"><?php echo e(rupiah($selectedOrder->total_price)); ?></span>
                        </div>
                        
                        <!--[if BLOCK]><![endif]--><?php if($selectedOrder->amount_received > 0): ?>
                        <div class="receipt-row">
                            <span class="receipt-label">Uang Diterima:</span>
                            <span class="receipt-value"><?php echo e(rupiah($selectedOrder->amount_received)); ?></span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Kembalian:</span>
                            <span class="receipt-value"><?php echo e(rupiah($selectedOrder->amount_received - $selectedOrder->total_price)); ?></span>
                        </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php else: ?>
                        <!-- Online orders - just show total -->
                        <div class="receipt-row receipt-total">
                            <span class="receipt-label">Total Harga:</span>
                            <span class="receipt-value"><?php echo e(rupiah($selectedOrder->total_price)); ?></span>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>

            <div class="modal-footer">
                <button wire:click="closeModal" class="btn-close-modal">Tutup</button>
            </div>
        </div>
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/orders/_modal.blade.php ENDPATH**/ ?>