<article class="rounded-3xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm p-5 flex flex-col md:flex-row gap-4">
    <div class="flex-1 space-y-2">
        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
            <span>#<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?></span>
            <span><?php echo e($order->created_at->translatedFormat('d M Y H:i')); ?></span>
        </div>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100"><?php echo e($order->product->name ?? 'Produk terhapus'); ?></h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Qty <?php echo e($order->quantity); ?> · <?php echo e(rupiah($order->total_price)); ?></p>
        <p class="text-sm text-gray-500 dark:text-gray-400">Status: <span class="font-semibold text-gray-900 dark:text-gray-100"><?php echo e(ucfirst($order->status)); ?></span></p>
        <?php if($order->notes): ?>
            <p class="text-sm text-gray-500 dark:text-gray-400">Catatan: <?php echo e($order->notes); ?></p>
        <?php endif; ?>
    </div>
    <div class="md:w-64 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/60 p-4 text-sm text-gray-600 dark:text-gray-300">
        <p class="font-semibold text-gray-900 dark:text-gray-100 mb-3">Detail Pengiriman</p>
        <div class="space-y-3">
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Nama Penerima</p>
                <p class="font-medium text-gray-900 dark:text-gray-200"><?php echo e($order->buyer_name); ?></p>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Kontak</p>
                <p class="font-medium text-gray-900 dark:text-gray-200"><?php echo e($order->buyer_contact ?? '-'); ?></p>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Alamat</p>
                <p class="font-medium text-gray-900 dark:text-gray-200"><?php echo e($order->shipping_address ?? 'Belum diisi'); ?></p>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Metode Pembayaran</p>
                <p class="font-medium text-gray-900 dark:text-gray-200"><?php echo e($order->payment_method === 'cash' ? 'Cash On Delivery' : ucfirst($order->payment_method)); ?></p>
            </div>
        </div>
    </div>
</article>
<?php /**PATH C:\laragon\www\thrif\resources\views\landing\components\order-card.blade.php ENDPATH**/ ?>