<!-- Left Column: Search + Products -->
<div class="flex-1 space-y-6">
    <!-- Pencarian Produk -->
    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="flex gap-3 items-center">
            <div class="flex-1">
                <div class="relative">
                    <label for="search" class="sr-only">Cari Produk</label>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input 
                        type="search" 
                        id="search"
                        name="search"
                        wire:model.live.debounce.300ms="search" 
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-900 dark:focus:ring-white focus:border-gray-900 dark:focus:border-gray-100 sm:text-sm transition duration-150 ease-in-out" 
                        placeholder="Ketik nama/kode/barcode produk..." 
                        autofocus
                    >
                </div>
            </div>

        </div>
    </div>

    <!-- Daftar Produk -->
    <?php if($loadProducts): ?>
        <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <button type="button" wire:click="addToCart(<?php echo e($product->id); ?>)" class="group relative flex flex-col bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg hover:border-gray-900 dark:hover:border-gray-100 transition-all duration-200 overflow-hidden text-left w-full aspect-square">
                        <!-- Product Image (60% height) -->
                        <div class="h-[60%] w-full bg-gray-100 dark:bg-gray-700 overflow-hidden relative">
                            <?php if($product->image): ?>
                                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Badges Overlay -->
                            <div class="absolute top-1 left-1 flex flex-col gap-1">
                                <?php if($product->is_on_sale): ?>
                                    <span class="bg-red-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow">
                                        -<?php echo e($product->discount_percent); ?>%
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="absolute top-1 right-1">
                                <span class="px-1.5 py-0.5 inline-flex text-[8px] font-bold rounded shadow-sm text-white uppercase tracking-wider <?php echo e($product->condition_class); ?>">
                                    <?php echo e($product->condition_label); ?>

                                </span>
                            </div>
                        </div>
                        
                        <!-- Card Content (40% height) -->
                        <div class="h-[40%] p-2 flex flex-col justify-between bg-white dark:bg-gray-800 relative z-10">
                            <!-- Product Name -->
                            <h3 class="text-[10px] font-medium text-gray-900 dark:text-white leading-tight line-clamp-2 mb-1 group-hover:text-black dark:group-hover:text-white transition-colors">
                                <?php echo e($product->name); ?>

                            </h3>
                            
                            <!-- Price -->
                            <div class="mt-auto">
                                <?php if($product->is_on_sale): ?>
                                    <div class="flex flex-col">
                                        <span class="text-[9px] text-gray-400 line-through leading-none mb-0.5"><?php echo e(rupiah($product->price)); ?></span>
                                        <span class="text-xs font-bold text-red-500 leading-none"><?php echo e(rupiah($product->final_price)); ?></span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-xs font-bold text-gray-900 dark:text-white leading-none"><?php echo e(rupiah($product->price)); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Hover Effect -->
                        <div class="absolute inset-0 bg-gray-900/0 group-hover:bg-gray-900/5 transition-colors duration-200 pointer-events-none z-0"></div>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-400">
                        <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p>Produk tidak ditemukan.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\www\thrif\resources\views\livewire\pos\_product-panel.blade.php ENDPATH**/ ?>