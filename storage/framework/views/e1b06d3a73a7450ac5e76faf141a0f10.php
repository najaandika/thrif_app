<div class="py-12">
    <div class="flex flex-row gap-6">
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
        
        <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-6xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <!-- Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">POS (Kasir Offline)</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola transaksi penjualan offline</p>
                    </div>

                    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
                        <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/40 dark:to-emerald-900/40 text-green-700 dark:text-green-200 border-l-4 border-green-500 shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold"><?php echo e(session('success')); ?></span>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    
                    <?php if(session()->has('error')): ?>
                        <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/40 dark:to-pink-900/40 text-red-700 dark:text-red-200 border-l-4 border-red-500 shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold"><?php echo e(session('error')); ?></span>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <form wire:submit.prevent="saveTransaction">
                        <div class="flex flex-col lg:flex-row gap-6">
                            <!-- Left Column: Search + Products -->
                            <div class="flex-1 space-y-6">
                        <!-- Pencarian Produk -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Cari Produk</label>
                            <div class="flex gap-3 items-center">
                                <div class="flex-1">
                                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-selector', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2033114865-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                </div>
                                <button wire:click="toggleBrowse" type="button" class="inline-flex items-center px-4 py-2.5 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                    Browse
                                </button>
                            </div>
                        </div>

                        <!-- Daftar Produk -->
                        <!--[if BLOCK]><![endif]--><?php if($loadProducts): ?>
                            <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3">
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <button type="button" wire:click="addToCart(<?php echo e($product->id); ?>)" class="group relative flex flex-col bg-white dark:bg-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg hover:border-gray-900 dark:hover:border-gray-100 transition-all duration-200 overflow-hidden text-left">
                                            <!-- Product Image -->
                                            <div class="aspect-square w-full bg-gray-100 dark:bg-gray-700 overflow-hidden">
                                                <!--[if BLOCK]><![endif]--><?php if($product->image): ?>
                                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                                <?php else: ?>
                                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                            
                                            <!-- Card Content -->
                                            <div class="p-3 flex flex-col flex-1">
                                            <!-- Stock Badge -->
                                            <div class="mb-2">
                                                <span class="px-2 py-0.5 inline-flex text-xs font-semibold rounded-full <?php echo e($product->stock > 10 ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-200' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-200')); ?>">
                                                    <?php echo e($product->stock); ?>

                                                </span>
                                            </div>
                                            
                                            <!-- Product Name -->
                                            <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-black dark:group-hover:text-white transition-colors flex-1">
                                                <?php echo e($product->name); ?>

                                            </h3>
                                            
                                            <!-- Price -->
                                            <div class="mt-auto">
                                                <p class="text-sm font-bold text-gray-900 dark:text-white whitespace-nowrap">
                                                    Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                                                </p>
                                            </div>
                                            </div>
                                            
                                            <!-- Hover Effect -->
                                            <div class="absolute inset-0 bg-gray-900/0 group-hover:bg-gray-900/5 transition-colors duration-200 pointer-events-none"></div>
                                        </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-400">
                                            <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                            <p>Produk tidak ditemukan.</p>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <!-- End Left Column -->

                            <!-- Right Column: Cart + Payment -->
                            <div class="w-full lg:w-96 space-y-6">
                        <!-- Keranjang Transaksi -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                                <h2 class="text-sm font-semibold text-gray-900 dark:text-white">Keranjang</h2>
                            </div>
                            <div class="p-4 max-h-80 overflow-y-auto">
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="flex items-center gap-3 py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                        <!-- Product Name & Qty -->
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate"><?php echo e($item['name']); ?></p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <input type="number" min="1" wire:model.lazy="cartQty.<?php echo e($item['id']); ?>" class="w-16 px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-1 focus:ring-gray-900 dark:focus:ring-gray-100">
                                                <span class="text-xs text-gray-500">×</span>
                                                <span class="text-xs text-gray-600 dark:text-gray-400">Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?></span>
                                            </div>
                                        </div>
                                        
                                        <!-- Subtotal & Delete -->
                                        <div class="flex flex-col items-end gap-1">
                                            <p class="text-sm font-bold text-gray-900 dark:text-white whitespace-nowrap">
                                                Rp <?php echo e(number_format($item['price'] * $item['qty'], 0, ',', '.')); ?>

                                            </p>
                                            <button type="button" wire:click="removeFromCart(<?php echo e($item['id']); ?>)" class="text-red-500 hover:text-red-700 p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="py-8 text-center text-gray-400">
                                        <svg class="mx-auto h-10 w-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <p class="text-sm">Keranjang kosong</p>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        <!-- Detail Pembayaran -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm space-y-6">
                            <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Detail Pembayaran</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Metode Pembayaran</label>
                                    <select id="payment_method" wire:model="payment_method" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-900 dark:focus:ring-gray-100 focus:border-transparent transition-all shadow-sm">
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="ewallet">Qris</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="amount_received" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Uang Diterima</label>
                                    <div wire:ignore>
                                        <input type="text" id="amount_received" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-900 dark:focus:ring-gray-100 focus:border-transparent transition-all shadow-sm" placeholder="0">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="discount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Diskon</label>
                                <div class="flex rounded-xl shadow-sm">
                                    <div class="relative flex-none">
                                        <select wire:model.live="discountType" class="h-full py-0 pl-4 pr-8 border-2 border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300 rounded-l-xl focus:ring-2 focus:ring-gray-900 dark:focus:ring-gray-100 focus:border-gray-900 dark:focus:border-gray-100 sm:text-sm">
                                            <option value="fixed">Rp</option>
                                            <option value="percent">%</option>
                                        </select>
                                    </div>
                                    <div wire:ignore class="flex-1 min-w-0">
                                        <input type="text" id="discount" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-r-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-900 dark:focus:ring-gray-100 focus:border-transparent transition-all" placeholder="0">
                                    </div>
                                </div>
                            </div>

                            <!-- Total Section -->
                            <div class="pt-6 border-t-2 border-gray-200 dark:border-gray-700 space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">Total:</span>
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">Rp <?php echo e(number_format($this->total(), 0, ',', '.')); ?></span>
                                </div>
                                <div class="flex justify-between items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl">
                                    <span class="text-base font-semibold text-gray-700 dark:text-gray-300">Kembalian:</span>
                                    <span class="text-lg font-bold text-green-600 dark:text-green-400">Rp <?php echo e(number_format($this->change(), 0, ',', '.')); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-gray-200 dark:border-gray-700">
                            <button type="submit" class="inline-flex items-center px-8 py-4 bg-gray-900 dark:bg-white border border-transparent rounded-xl font-bold text-base text-white dark:text-gray-900 uppercase tracking-wider hover:bg-black dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-900 dark:focus:ring-white focus:ring-offset-2 transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100" <?php if(count($cart) == 0): ?> disabled <?php endif; ?>>
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function formatNumber(num) {
        if (!num) return '';
        return num.toString().replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function unformatNumber(str) {
        if (!str) return 0;
        return str.toString().replace(/\./g, '');
    }

    function setupInput(id) {
        const el = document.getElementById(id);
        if (!el) return;

        el.addEventListener('input', function(e) {
            // Save cursor position
            const start = this.selectionStart;
            const oldVal = this.value;
            
            // Format
            const formatted = formatNumber(this.value);
            this.value = formatted;
            
            // Restore cursor (approximate)
            // Simple logic: if length changed, adjust cursor
            // For now, just putting it at end is annoying, so let's try to keep it logic
            // But for simple thousand separator, just letting it jump to end is often acceptable or standard simple impl
            // Let's try to be smart:
            // If user deletes a dot, the cursor might jump.
            
            // Update Livewire
            const raw = unformatNumber(formatted);
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set(id, raw);
        });
    }

    setupInput('amount_received');
    setupInput('discount');

    // Listen for reset event
    Livewire.on('transaction-completed', () => {
        const amountEl = document.getElementById('amount_received');
        const discountEl = document.getElementById('discount');
        if (amountEl) amountEl.value = '';
        if (discountEl) discountEl.value = '';
    });

    // Listen for discount reset
    Livewire.on('reset-discount', () => {
        const discountEl = document.getElementById('discount');
        if (discountEl) discountEl.value = '';
    });
});
</script>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/pos/index.blade.php ENDPATH**/ ?>