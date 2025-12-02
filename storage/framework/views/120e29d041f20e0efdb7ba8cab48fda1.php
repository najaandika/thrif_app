<!-- Recent Products -->
<div class="card-base card-recent-products">
    <div class="card-header">
        <div class="card-header-content">
            <div>
                <h3 class="card-title">Produk Terbaru</h3>
                <p class="card-subtitle">Produk terakhir yang kamu tambahkan</p>
            </div>
            <a href="<?php echo e(route('products.index')); ?>" class="view-all-btn">
                Lihat semua
            </a>
        </div>
    </div>

    <div class="list-container">
        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $recent_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="product-item">
                <!--[if BLOCK]><![endif]--><?php if($product->image): ?>
                    <img src="<?php echo e(Storage::url($product->image)); ?>" alt="<?php echo e($product->name); ?>" class="product-image-sm" />
                <?php else: ?>
                    <div class="product-placeholder">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <div class="product-details">
                    <p class="product-name"><?php echo e($product->name); ?></p>
                    <p class="product-price-sm">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
                </div>

                <div>
                    <!--[if BLOCK]><![endif]--><?php if($product->is_available): ?>
                        <span class="badge-available">Tersedia</span>
                    <?php else: ?>
                        <span class="badge-sold">Terjual</span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state-container">
                <div class="empty-state-icon-wrapper">
                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <p class="empty-state-title">Belum ada produk</p>
                <p class="empty-state-desc">Mulai dengan menambahkan produk pertama</p>
                <a href="<?php echo e(route('products.create')); ?>" class="add-first-product-btn">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah produk pertama
                </a>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/dashboard/recent-products.blade.php ENDPATH**/ ?>