<section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-6">
    <div class="space-y-1">
        <p class="<?php echo e($labelClass); ?>">Form Pembelian</p>
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Isi data pengirimanmu</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Semua data akan dijaga kerahasiaannya</p>
    </div>
    
    <?php echo $__env->make('landing.components.order-form-fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</section>
<?php /**PATH C:\laragon\www\thrif\resources\views\landing\components\order-form.blade.php ENDPATH**/ ?>