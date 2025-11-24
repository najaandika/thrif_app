<div class="relative" x-data @click.away="$wire.query = ''">
    <input wire:model.debounce.300ms="query" class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Ketik nama/kode/barcode produk..." />

    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
        <svg class="h-5 w-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>

    <!--[if BLOCK]><![endif]--><?php if($results->count()): ?>
        <ul class="mt-1 absolute z-50 w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg max-h-64 overflow-auto">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li wire:click.prevent="select(<?php echo e($r->id); ?>)" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer flex justify-between items-center">
                    <div>
                        <div class="font-medium text-sm text-gray-900 dark:text-gray-100"><?php echo e($r->name); ?></div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Rp <?php echo e(number_format($r->price,0,',','.')); ?> • Stok: <?php echo e($r->stock); ?></div>
                    </div>
                    <div class="text-xs text-gray-400">#<?php echo e($r->id); ?></div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </ul>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/product-selector.blade.php ENDPATH**/ ?>