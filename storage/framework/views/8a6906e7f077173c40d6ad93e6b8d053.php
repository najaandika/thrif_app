

<?php $__env->startSection('title', 'Cari Produk'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Hasil Pencarian Produk</h1>
    <form action="<?php echo e(route('products.search')); ?>" method="get" class="mb-6 flex gap-2">
        <input type="text" name="q" value="<?php echo e($query); ?>" placeholder="Cari produk..." class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold">Cari</button>
    </form>
    <?php if($products->count()): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="border rounded-xl p-4 bg-white dark:bg-gray-900 shadow relative overflow-hidden">
                    <a href="<?php echo e(route('landing.products.checkout', $product)); ?>" class="block">
                        <div class="relative">
                            <img src="<?php echo e($product->image ? Storage::url($product->image) : 'https://via.placeholder.com/200x150?text=No+Image'); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-36 object-cover rounded mb-2">
                            <?php if($product->is_on_sale): ?>
                                <div class="absolute top-2 left-2 bg-gradient-to-r from-red-500 to-orange-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow">
                                    -<?php echo e($product->discount_percent); ?>%
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="font-bold text-lg text-gray-900 dark:text-gray-100"><?php echo e($product->name); ?></div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kategori: <?php echo e($product->category); ?></div>
                        <?php if($product->is_on_sale): ?>
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-400 line-through"><?php echo e(rupiah($product->price)); ?></span>
                                <span class="text-red-500 font-bold"><?php echo e(rupiah($product->final_price)); ?></span>
                            </div>
                        <?php else: ?>
                            <div class="text-emerald-600 dark:text-emerald-400 font-semibold"><?php echo e(rupiah($product->price)); ?></div>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-6"><?php echo e($products->links()); ?></div>
    <?php else: ?>
        <div class="text-gray-500 dark:text-gray-400 py-8 text-center">Tidak ada produk ditemukan untuk "<?php echo e($query); ?>"</div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\thrif\resources\views\landing\sections\product-search-results.blade.php ENDPATH**/ ?>