<div class="landing-container">

    <div class="search-form relative" x-data="{ open: false }">
        <a href="<?php echo e(route('landing.home')); ?>" class="back-btn" aria-label="Kembali">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
        </a>
        
        <div class="search-wrapper relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input
                type="text"
                wire:model.debounce.400ms="search"
                placeholder="Cari produk..."
                class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 text-left"
                aria-label="Cari produk"
            >
        </div>
        
        <button 
            type="button" 
            @click="open = !open"
            class="ml-2 px-3 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white transition-all inline-flex items-center gap-1 shadow-md shadow-slate-900/40"
            aria-label="Filter"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
            </svg>
            <svg class="w-2.5 h-2.5 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        
        <div 
            x-show="open" 
            x-cloak
            @click.outside="open = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="absolute right-0 top-full mt-2 w-56 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-xl z-50 overflow-hidden"
        >
            
                <div class="p-3 border-b border-gray-100 dark:border-gray-700">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">Status</p>
                    <div class="space-y-1">
                        <button 
                            type="button" 
                            wire:click="resetFilters" 
                            @click="open = false"
                            class="w-full text-left px-3 py-2 rounded-lg text-sm transition-all flex items-center gap-2
                                <?php echo e(!$promo && $category === '' ? 'bg-slate-100 dark:bg-slate-700 text-slate-900 dark:text-white font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'); ?>"
                        >
                            <span class="w-4 h-4 rounded-full border-2 <?php echo e(!$promo && $category === '' ? 'border-slate-600 bg-slate-600' : 'border-gray-300 dark:border-gray-600'); ?>"></span>
                            Semua Produk
                        </button>
                        <button 
                            type="button" 
                            wire:click="togglePromo" 
                            @click="open = false"
                            class="w-full text-left px-3 py-2 rounded-lg text-sm transition-all flex items-center gap-2
                                <?php echo e($promo ? 'bg-gradient-to-r from-red-50 to-orange-50 dark:from-red-900/30 dark:to-orange-900/30 text-red-600 dark:text-red-400 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'); ?>"
                        >
                            <span class="w-4 h-4 rounded-full border-2 <?php echo e($promo ? 'border-red-500 bg-red-500' : 'border-gray-300 dark:border-gray-600'); ?>"></span>
                            🔥 Flash Sale
                        </button>
                    </div>
                </div>

                
                <div class="p-3 max-h-48 overflow-y-auto">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">Kategori</p>
                    <div class="space-y-1">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button 
                                type="button" 
                                wire:click="$set('category', '<?php echo e($category === $slug ? '' : $slug); ?>')" 
                                @click="open = false"
                                class="w-full text-left px-3 py-2 rounded-lg text-sm transition-all flex items-center gap-2
                                    <?php echo e($category === $slug ? 'bg-slate-100 dark:bg-slate-700 text-slate-900 dark:text-white font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'); ?>"
                            >
                                <span class="w-4 h-4 rounded border <?php echo e($category === $slug ? 'border-slate-600 bg-slate-600' : 'border-gray-300 dark:border-gray-600'); ?> flex items-center justify-center">
                                    <?php if($category === $slug): ?>
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    <?php endif; ?>
                                </span>
                                <?php echo e($name); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    
    <?php if($promo || $category): ?>
        <div class="mt-3 flex items-center gap-2 text-xs">
            <?php if($promo): ?>
                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-gradient-to-r from-red-500 to-orange-500 text-white">
                    🔥 Flash Sale
                    <button type="button" wire:click="$set('promo', false)" class="ml-1 hover:opacity-70">×</button>
                </span>
            <?php endif; ?>
            <?php if($category): ?>
                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-slate-800 text-white">
                    <?php echo e($category); ?>

                    <button type="button" wire:click="$set('category', '')" class="ml-1 hover:opacity-70">×</button>
                </span>
            <?php endif; ?>
            <button type="button" wire:click="resetFilters" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 underline">Reset</button>
        </div>
    <?php endif; ?>
    <?php if($products->count()): ?>
        <div class="mt-5 sm:mt-6 product-grid">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-card">
                    <a href="<?php echo e(route('landing.products.checkout', ['product' => $product, 'from' => 'catalog'])); ?>" class="block">
                        <div class="relative">
                            <img src="<?php echo e($product->image ? Storage::url($product->image) : 'https://via.placeholder.com/200x150?text=No+Image'); ?>" alt="<?php echo e($product->name); ?>" class="product-image">
                            <?php if($product->stock === 0): ?>
                                <span class="badge-out-of-stock">Out of Stock</span>
                            <?php else: ?>
                                <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded text-[10px] font-bold text-white shadow-sm
                                    <?php echo e($product->condition === 'new' ? 'bg-blue-500' : 
                                      ($product->condition === 'like-new' ? 'bg-indigo-500' : 
                                      ($product->condition === 'good' ? 'bg-emerald-500' : 
                                      ($product->condition === 'fair' ? 'bg-yellow-500' : 'bg-orange-500')))); ?>">
                                    <?php echo e($product->condition_label); ?>

                                </span>
                            <?php endif; ?>
                            <?php if($product->is_on_sale): ?>
                                <span class="absolute top-1.5 right-1.5 px-2 py-0.5 rounded text-[10px] font-bold text-white shadow-sm bg-gradient-to-r from-red-500 to-orange-500 animate-pulse">
                                    -<?php echo e($product->discount_percent); ?>%
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <div class="product-title"><?php echo e($product->name); ?></div>
                            <div class="flex items-center justify-between mt-2">
                                <?php if($product->is_on_sale): ?>
                                    <div>
                                        <span class="text-xs text-gray-400 line-through"><?php echo e(rupiah($product->price)); ?></span>
                                        <span class="text-red-500 font-bold text-sm"><?php echo e(rupiah($product->final_price)); ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="text-green-600 font-bold text-sm"><?php echo e(rupiah($product->price)); ?></div>
                                <?php endif; ?>
                                <?php if($product->is_available): ?>
                                    <div class="flex items-center gap-2">
                                        <form action="<?php echo e(route('landing.cart.store')); ?>" method="POST" onclick="event.stopPropagation();">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-900 text-white px-2.5 py-2 shadow-md hover:bg-slate-800 transition focus:outline-none hover:opacity-90">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="pagination-container"><?php echo e($products->links()); ?></div>
    <?php else: ?>
        <div class="empty-state">Tidak ada produk ditemukan untuk "<?php echo e(request('search')); ?>"</div>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\www\thrif\resources\views\livewire\landing-products\index.blade.php ENDPATH**/ ?>