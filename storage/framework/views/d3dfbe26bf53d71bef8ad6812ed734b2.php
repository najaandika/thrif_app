<div class="admin-table-container">
    <table class="admin-table">
        <thead class="admin-thead">
            <tr>
                <th class="admin-th">Image</th>
                <th class="admin-th">Name</th>
                <th class="admin-th">Price</th>
                <th class="admin-th">Condition</th>
                <th class="admin-th">Category</th>
                <th class="admin-th">Size</th>
                <th class="admin-th">Status</th>
                <th class="admin-th-right">Actions</th>
            </tr>
        </thead>
        <tbody class="admin-tbody">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="admin-tr">
                    <td class="admin-td">
                        <?php if($product->image): ?>
                            <img src="<?php echo e(Storage::url($product->image)); ?>" alt="<?php echo e($product->name); ?>" class="h-14 w-14 rounded-xl object-cover shadow-md ring-2 ring-indigo-100 dark:ring-indigo-900 hover:scale-110 transition-transform duration-200">
                        <?php else: ?>
                            <div class="h-14 w-14 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-primary"><?php echo e($product->name); ?></div>
                    </td>
                    <td class="admin-td">
                        <div class="text-primary"><?php echo e(rupiah($product->price)); ?></div>
                    </td>
                    <td class="admin-td">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full text-white shadow-md
                            <?php echo e($product->condition === 'new' ? 'bg-blue-500' : 
                              ($product->condition === 'like-new' ? 'bg-indigo-500' : 
                              ($product->condition === 'good' ? 'bg-emerald-500' : 
                              ($product->condition === 'fair' ? 'bg-yellow-500' : 'bg-orange-500')))); ?>">
                            <?php echo e($product->condition_label); ?>

                        </span>
                    </td>
                    <td class="admin-td">
                        <span class="text-secondary"><?php echo e($product->category ?? '-'); ?></span>
                    </td>
                    <td class="admin-td">
                        <span class="text-secondary"><?php echo e($product->size ?? '-'); ?></span>
                    </td>
                    <td class="admin-td">
                        <?php if($product->is_available): ?>
                            <span class="status-badge-available">Available</span>
                        <?php else: ?>
                            <span class="status-badge-sold">Sold</span>
                        <?php endif; ?>
                    </td>
                    <td class="admin-td text-right space-x-2">
                        <?php if($product->is_available): ?>
                            <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn-action-edit">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                        <?php endif; ?>
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
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="pagination-wrapper">
    <?php echo e($products->links()); ?>

</div><?php /**PATH C:\laragon\www\thrif\resources\views\livewire\products\_table.blade.php ENDPATH**/ ?>