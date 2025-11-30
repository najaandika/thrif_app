<div class="landing-container">

    <form action="<?php echo e(route('landing.products.index')); ?>" method="get" class="search-form">
        <a href="<?php echo e(route('landing.home')); ?>" class="back-btn" aria-label="Kembali">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
        </a>
        <div class="search-wrapper">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari produk..." class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 text-left" aria-label="Cari produk" style="text-align:left;">
        </div>
        <button type="submit" class="ml-2 px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold transition-all" aria-label="Cari">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </form>
    <!--[if BLOCK]><![endif]--><?php if($products->count()): ?>
        <div class="product-grid">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-card">
                    <a href="<?php echo e(route('landing.products.checkout', $product)); ?>" class="block">
                        <div class="relative">
                            <img src="<?php echo e($product->image ? Storage::url($product->image) : 'https://via.placeholder.com/200x150?text=No+Image'); ?>" alt="<?php echo e($product->name); ?>" class="product-image">
                            <!--[if BLOCK]><![endif]--><?php if($product->stock === 0): ?>
                                <span class="badge-out-of-stock">Out of Stock</span>
                            <?php elseif($product->created_at && $product->created_at->gt(now()->subDays(7))): ?>
                                <span class="badge-new">New</span>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="product-info">
                            <div class="product-title"><?php echo e($product->name); ?></div>
                            <div class="product-price">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></div>
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