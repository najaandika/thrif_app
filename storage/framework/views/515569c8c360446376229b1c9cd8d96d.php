

<div class="py-12">
    <div>
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
            <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900 dark:to-emerald-900 text-green-700 dark:text-green-200 rounded-xl border-l-4 border-green-500 shadow-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold"><?php echo e(session('message')); ?></span>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <div class="flex flex-row gap-6">
            <?php if (isset($component)) { $__componentOriginal2880b66d47486b4bfeaf519598a469d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2880b66d47486b4bfeaf519598a469d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $attributes = $__attributesOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $component = $__componentOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__componentOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>

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
                                    <input wire:model.live="search" type="text" placeholder="Cari ID / metode / status" class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="transactions-table">
                                <thead class="transactions-thead">
                                    <tr>
                                        <th class="transactions-th">ID</th>
                                        <th class="transactions-th">Tanggal</th>
                                        <th class="transactions-th">Produk</th>
                                        <th class="transactions-th-right">Qty</th>
                                        <th class="transactions-th-right">Diskon</th>
                                        <th class="transactions-th-right">Total</th>
                                        <th class="transactions-th">Metode</th>
                                        <th class="transactions-th">Status</th>
                                        <th class="transactions-th-actions">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="transactions-tbody">
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="transactions-tr">
                                            <td class="transactions-td">
                                                <div class="transaction-id">#<?php echo e($t->id); ?></div>
                                            </td>
                                            <td class="transactions-td">
                                                <div class="transaction-date"><?php echo e($t->created_at->format('Y-m-d H:i')); ?></div>
                                            </td>
                                            <td class="transactions-td">
                                                <div class="transaction-products">
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $t->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="product-name"><?php echo e($item->product->name ?? 'N/A'); ?></div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </div>
                                            </td>
                                            <td class="transactions-td text-right">
                                                <span class="transaction-qty"><?php echo e($t->total_qty ?? '-'); ?></span>
                                            </td>
                                            <td class="transactions-td text-right">
                                                <div class="transaction-discount text-red-500 font-medium">
                                                    <?php echo e($t->discount > 0 ? '- Rp ' . number_format($t->discount, 0, ',', '.') : '-'); ?>

                                                </div>
                                            </td>
                                            <td class="transactions-td text-right">
                                                <div class="transaction-total">Rp <?php echo e(number_format($t->total_price, 0, ',', '.')); ?></div>
                                            </td>
                                            <td class="transactions-td">
                                                <div class="transaction-method">
                                                    <?php echo e($t->payment_method === 'ewallet' ? 'Qris' : ucfirst($t->payment_method)); ?>

                                                </div>
                                            </td>
                                            <td class="transactions-td">
                                                <span class="status-badge <?php echo e($t->payment_status === 'paid' ? 'status-paid' : 'status-unpaid'); ?>"><?php echo e($t->payment_status); ?></span>
                                            </td>
                                            <td class="transactions-td text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button wire:click="viewTransaction(<?php echo e($t->id); ?>)" class="view-btn">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        Lihat
                                                    </button>
                                                    <button type="button" onclick="confirmDeleteTransaction(<?php echo e($t->id); ?>)" class="delete-btn">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="8" class="empty-transactions">Belum ada transaksi.</td>
                                        </tr>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination-wrapper">
                            <?php echo e($transactions->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Detail Modal -->
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
                    <!-- Transaction Info -->
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

                    <!-- Items -->
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

                    <!-- Summary -->
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

                    <!-- Notes -->
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

    <script>
        function confirmDeleteTransaction(id) {
            if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('delete', id);
            }
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/transactions/index.blade.php ENDPATH**/ ?>