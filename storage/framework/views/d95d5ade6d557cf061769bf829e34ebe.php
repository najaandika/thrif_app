<!--[if BLOCK]><![endif]--><?php if($showModal && $selectedTransaction): ?>
    <div class="modal-overlay" wire:click="closeModal">
        <div class="modal-container" wire:click.stop>
            <div class="modal-header">
                <h3 class="modal-title">Detail Transaksi #<?php echo e($selectedTransaction->id); ?></h3>
                <button wire:click="closeModal" class="modal-close">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <div class="receipt-section">
                    <div class="receipt-row">
                        <span class="receipt-label">Tanggal:</span>
                        <span class="receipt-value"><?php echo e($selectedTransaction->created_at->format('d M Y, H:i')); ?></span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Metode Pembayaran:</span>
                        <span class="receipt-value">
                            <?php echo e($selectedTransaction->payment_method === 'ewallet' ? 'Qris' : ucfirst($selectedTransaction->payment_method)); ?>

                        </span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Status:</span>
                        <span class="status-badge <?php echo e($selectedTransaction->payment_status === 'paid' ? 'status-paid' : 'status-unpaid'); ?>">
                            <?php echo e($selectedTransaction->payment_status); ?>

                        </span>
                    </div>
                </div>

                <div class="receipt-section">
                    <h4 class="receipt-section-title">Item Produk</h4>
                    <div class="receipt-items">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $selectedTransaction->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="receipt-item">
                                <div class="receipt-item-info">
                                    <div class="receipt-item-name"><?php echo e($item->product->name ?? 'Produk tidak tersedia'); ?></div>
                                    <div class="receipt-item-detail"><?php echo e($item->qty); ?> x Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></div>
                                </div>
                                <div class="receipt-item-subtotal">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <div class="receipt-section receipt-summary">
                    <div class="receipt-row">
                        <span class="receipt-label">Total Qty:</span>
                        <span class="receipt-value font-semibold"><?php echo e($selectedTransaction->total_qty); ?></span>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($selectedTransaction->discount > 0): ?>
                        <div class="receipt-row">
                            <span class="receipt-label">Diskon:</span>
                            <span class="receipt-value text-red-500 font-medium">- Rp <?php echo e(number_format($selectedTransaction->discount, 0, ',', '.')); ?></span>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <div class="receipt-row receipt-total">
                        <span class="receipt-label">Total Harga:</span>
                        <span class="receipt-value">Rp <?php echo e(number_format($selectedTransaction->total_price, 0, ',', '.')); ?></span>
                    </div>
                </div>

                <!--[if BLOCK]><![endif]--><?php if($selectedTransaction->notes): ?>
                    <div class="receipt-section">
                        <h4 class="receipt-section-title">Catatan</h4>
                        <p class="receipt-notes"><?php echo e($selectedTransaction->notes); ?></p>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div class="modal-footer">
                <button wire:click="closeModal" class="btn-close-modal">Tutup</button>
            </div>
        </div>
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/transactions/_modal.blade.php ENDPATH**/ ?>