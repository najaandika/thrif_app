<div class="landing-container">

    <div class="search-form">
        <a href="<?php echo e(route('landing.home')); ?>" class="back-btn" aria-label="Kembali">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
        </a>
        <div class="search-wrapper">
            <input
                type="text"
                wire:model.debounce.400ms="search"
                placeholder="Cari produk..."
                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 text-left"
                aria-label="Cari produk"
                style="text-align:left;"
            >
        </div>
        <button type="button" class="ml-2 px-4 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-semibold shadow-md shadow-slate-900/40 transition-all" aria-label="Cari">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    
    <div class="mt-5 sm:mt-6 flex flex-wrap gap-2">
        <button
            type="button"
            wire:click="$set('category', '')"
            class="px-3 py-1.5 rounded-full text-xs font-semibold border transition-all
                <?php echo e($category === ''
                    ? 'bg-slate-800 dark:bg-slate-700 border-slate-600 text-white shadow-sm shadow-slate-900/40'
                    : 'bg-white dark:bg-slate-900 border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-200 hover:border-slate-500'); ?>">
            Semua
        </button>

        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button
                type="button"
                wire:click="$set('category', '<?php echo e($slug); ?>')"
                class="px-3 py-1.5 rounded-full text-xs font-semibold border transition-all
                    <?php echo e($category === $slug
                        ? 'bg-slate-800 dark:bg-slate-700 border-slate-600 text-white shadow-sm shadow-slate-900/40'
                        : 'bg-white dark:bg-slate-900 border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-200 hover:border-slate-500'); ?>">
                <?php echo e($name); ?>

            </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
    <!--[if BLOCK]><![endif]--><?php if($products->count()): ?>
        <div class="mt-5 sm:mt-6 product-grid">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-card">
                    <a href="<?php echo e(route('landing.products.checkout', $product)); ?>" class="block">
                        <div class="relative">
                            <img src="<?php echo e($product->image ? Storage::url($product->image) : 'https://via.placeholder.com/200x150?text=No+Image'); ?>" alt="<?php echo e($product->name); ?>" class="product-image">
                            <!--[if BLOCK]><![endif]--><?php if($product->stock === 0): ?>
                                <span class="badge-out-of-stock">Out of Stock</span>
                            <?php else: ?>
                                <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded text-[10px] font-bold text-white shadow-sm
                                    <?php echo e($product->condition === 'new' ? 'bg-blue-500' : 
                                      ($product->condition === 'like-new' ? 'bg-indigo-500' : 
                                      ($product->condition === 'good' ? 'bg-emerald-500' : 
                                      ($product->condition === 'fair' ? 'bg-yellow-500' : 'bg-orange-500')))); ?>">
                                    <?php echo e($product->condition_label); ?>

                                </span>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="product-info">
                            <div class="product-title"><?php echo e($product->name); ?></div>
                            <div class="text-green-600 font-bold text-sm"><?php echo e(rupiah($product->price)); ?></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </div>
        <div class="pagination-container"><?php echo e($products->links()); ?></div>
    <?php else: ?>
        <div class="empty-state">Tidak ada produk ditemukan untuk "<?php echo e(request('search')); ?>"</div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>

<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/landing-products/index.blade.php ENDPATH**/ ?>