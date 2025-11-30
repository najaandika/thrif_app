<div class="admin-wrapper">
    <div>
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
            <div class="alert-message">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold"><?php echo e(session('message')); ?></span>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <div class="admin-layout">
            <?php if (isset($component)) { $__componentOriginal2880b66d47486b4bfeaf519598a469d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2880b66d47486b4bfeaf519598a469d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $attributes = $__attributesOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $component = $__componentOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__componentOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>

            <!-- Main Content -->
            <div class="admin-content">
                <div class="admin-card">
                    <div class="admin-card-body">
                        <div class="admin-header-simple">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input wire:model.live="search" id="product_search" name="product_search" type="text" placeholder="Search products..." class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
                            </div>
                            <a href="<?php echo e(route('products.create')); ?>" class="btn-primary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Product
                            </a>
                        </div>

                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead class="admin-thead">
                                <tr>
                                    <th class="admin-th">Image</th>
                                    <th class="admin-th">Name</th>
                                    <th class="admin-th">Price</th>
                                    <th class="admin-th">Stock</th>
                                    <th class="admin-th">Condition</th>
                                    <th class="admin-th">Category</th>
                                    <th class="admin-th">Size</th>
                                    <th class="admin-th">Status</th>
                                    <th class="admin-th-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="admin-tbody">
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="admin-tr">
                                        <td class="admin-td">
                                            <!--[if BLOCK]><![endif]--><?php if($product->image): ?>
                                                <img src="<?php echo e(Storage::url($product->image)); ?>" alt="<?php echo e($product->name); ?>" class="h-14 w-14 rounded-xl object-cover shadow-md ring-2 ring-indigo-100 dark:ring-indigo-900 hover:scale-110 transition-transform duration-200">
                                            <?php else: ?>
                                                <div class="h-14 w-14 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded-xl flex items-center justify-center shadow-md">
                                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-primary"><?php echo e($product->name); ?></div>
                                        </td>
                                        <td class="admin-td">
                                            <div class="text-primary">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></div>
                                        </td>
                                        <td class="admin-td">
                                            <span class="stock-badge <?php echo e($product->stock > 0 ? 'stock-badge-available' : 'stock-badge-low'); ?>">
                                                <?php echo e($product->stock); ?> in stock
                                            </span>
                                        </td>
                                        <td class="admin-td">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-md">
                                                <?php echo e(ucfirst($product->condition)); ?>

                                            </span>
                                        </td>
                                        <td class="admin-td">
                                            <span class="text-secondary"><?php echo e($product->category ?? '-'); ?></span>
                                        </td>
                                        <td class="admin-td">
                                            <span class="text-secondary"><?php echo e($product->sizes->pluck('size')->join(', ') ?: '-'); ?></span>
                                        </td>
                                        <td class="admin-td">
                                            <!--[if BLOCK]><![endif]--><?php if($product->is_available): ?>
                                                <span class="status-badge-available">Available</span>
                                            <?php else: ?>
                                                <span class="status-badge-sold">Sold</span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td class="admin-td text-right space-x-2">
                                            <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn-action-edit">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button type="button" onclick="confirmDelete(<?php echo e($product->id); ?>)" class="btn-action-delete">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9" class="empty-state">
                                            No products found.
                                        </td>
                                    </tr>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrapper">
                        <?php echo e($products->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\thrif\resources\views/livewire/products/index.blade.php ENDPATH**/ ?>