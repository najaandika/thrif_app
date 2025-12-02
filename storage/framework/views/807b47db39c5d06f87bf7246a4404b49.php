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
                    <td colspan="9" class="empty-transactions">Belum ada transaksi.</td>
                </tr>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </tbody>
    </table>
</div>
<div class="pagination-wrapper">
    <?php echo e($transactions->links()); ?>

</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/transactions/_table.blade.php ENDPATH**/ ?>