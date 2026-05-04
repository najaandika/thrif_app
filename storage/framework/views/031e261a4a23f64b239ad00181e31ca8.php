<div class="relative" x-data @click.away="$wire.query = ''">
    <input wire:model.debounce.300ms="query" id="product_selector_search" name="product_search" aria-label="Cari Produk" class="w-full pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500" placeholder="Ketik nama/kode/barcode produk..." />

    <?php if($results->count()): ?>
        <ul class="mt-1 absolute z-50 w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg max-h-64 overflow-auto">
            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li wire:click.prevent="select(<?php echo e($r->id); ?>)" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer flex justify-between items-center">
                    <div>
                        <div class="font-medium text-sm text-gray-900 dark:text-gray-100"><?php echo e($r->name); ?></div>
                        <div class="text-xs text-gray-500 dark:text-gray-400"><?php echo e(rupiah($r->price, false)); ?> • Stok: <?php echo e($r->stock); ?></div>
                    </div>
                    <div class="text-xs text-gray-400">#<?php echo e($r->id); ?></div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\www\thrif\resources\views\livewire\product-selector.blade.php ENDPATH**/ ?>