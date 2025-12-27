<section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-4">
    <p class="<?php echo e($labelClass); ?>">Produk</p>

    <div class="space-y-4">
        
        <div class="w-full">
            <div class="rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 w-full aspect-square mx-auto group relative shadow-sm">
                <?php $gallery = $product->gallery; ?>
                <?php if($gallery->isNotEmpty()): ?>
                    <div class="flex overflow-x-auto snap-x snap-mandatory h-full w-full no-scrollbar">
                        <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(Storage::url($img->image_path)); ?>" 
                                 alt="<?php echo e($product->name); ?>" 
                                 class="w-full h-full object-cover flex-shrink-0 snap-center">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 via-slate-100 to-slate-300 dark:from-slate-800 dark:via-slate-700 dark:to-slate-900 flex items-center justify-center text-[10px] text-gray-500 dark:text-gray-300 text-center p-2">
                        Foto produk menyusul
                    </div>
                <?php endif; ?>
                <?php if($product->is_on_sale): ?>
                    <div class="absolute top-2 left-2 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg animate-pulse">
                        -<?php echo e($product->discount_percent); ?>% OFF
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="space-y-3">
            <div class="text-center">
                <h1 class="text-lg font-bold text-gray-900 dark:text-gray-100 leading-tight px-2"><?php echo e($product->name); ?></h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5"><?php echo e($product->category ?? 'Tanpa kategori'); ?></p>
            </div>
            
            <div class="flex flex-wrap items-center justify-center gap-2">
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg font-bold text-xs text-white shadow-sm <?php echo e($product->condition_class); ?>">
                    <?php echo e($product->condition_label); ?>

                </span>
                <span class="px-3 py-1 rounded-lg bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-sm font-bold shadow-md ring-1 ring-gray-900/10 dark:ring-gray-100/20">
                    Size <?php echo e($product->size ?? '-'); ?>

                </span>
            </div>

            <div class="text-center pt-1">
                <?php if($product->is_on_sale): ?>
                    <p class="text-lg text-gray-400 line-through"><?php echo e(rupiah($product->price)); ?></p>
                    <p class="text-3xl font-extrabold text-red-500 tracking-tight"><?php echo e(rupiah($product->final_price)); ?></p>
                    <p class="text-xs text-red-500 font-medium">Hemat <?php echo e(rupiah($product->price - $product->final_price)); ?>!</p>
                <?php else: ?>
                    <p class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 tracking-tight"><?php echo e(rupiah($product->price)); ?></p>
                <?php endif; ?>
            </div>

            <?php if($product->description): ?>
                <div class="p-4 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 text-left">
                    <h3 class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2 border-b border-gray-200 dark:border-gray-700 pb-2">Deskripsi Produk</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed"><?php echo e(strip_tags($product->description)); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php /**PATH C:\laragon\www\thrif\resources\views/landing/sections/checkout/product-info.blade.php ENDPATH**/ ?>