
<div class="space-y-3">
    <div class="flex items-center gap-2">
        <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
        </div>
        <p class="text-[11px] font-semibold tracking-[0.2em] text-gray-500 dark:text-gray-400 uppercase">Ringkasan Order</p>
    </div>
    <div class="rounded-2xl border-2 border-gray-200 dark:border-gray-700 p-5 bg-gradient-to-br from-gray-50 to-gray-100/50 dark:from-gray-800/40 dark:to-gray-800/20 space-y-3 text-sm text-gray-700 dark:text-gray-200">
        <div class="flex items-center justify-between">
            <span>Harga</span>
            <span class="font-semibold text-gray-900 dark:text-gray-100"><?php echo e(rupiah($product->price)); ?></span>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/landing/components/order-summary.blade.php ENDPATH**/ ?>