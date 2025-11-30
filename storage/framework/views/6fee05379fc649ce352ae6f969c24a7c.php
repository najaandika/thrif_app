<div class="py-12">
    <div>
        <div class="flex flex-col lg:flex-row gap-6">
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
                <!-- Page Header -->
                <div class="mb-6">
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-2">
                        <a href="<?php echo e(route('orders.index')); ?>" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Orders</a>
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">Create New</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Tambah Order Baru</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Buat order untuk produk yang tersedia.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl border-l-4 border-indigo-500">
                    <!-- Card Header -->
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-50/50 to-purple-50/50 dark:from-indigo-900/20 dark:to-purple-900/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Order Information</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">Enter customer and product details</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <form wire:submit="save" id="orderForm">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Order</h2>
                                    <a href="<?php echo e(route('orders.index')); ?>" class="text-sm text-indigo-600 dark:text-indigo-300 font-semibold hover:underline"></a>
                                </div>

                                <div>
                                    <label for="product_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Produk *</label>
                                    <select wire:model="product_id" name="product_id" id="product_id" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Pilih produk</option>
                                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> (stok: <?php echo e($product->stock); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <option value="" disabled>Belum ada produk dengan stok</option>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="buyer_name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Pembeli *</label>
                                        <input wire:model="buyer_name" name="buyer_name" autocomplete="name" type="text" id="buyer_name" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan nama pembeli">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['buyer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <div>
                                        <label for="buyer_contact" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Kontak (WhatsApp/Email)</label>
                                        <input wire:model="buyer_contact" name="buyer_contact" autocomplete="tel" type="text" id="buyer_contact" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500" placeholder="08123... / email">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['buyer_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>

                                <div>
                                    <label for="shipping_address" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Alamat Pengiriman</label>
                                    <textarea wire:model="shipping_address" name="shipping_address" autocomplete="street-address" id="shipping_address" rows="3" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500" placeholder="Opsional"></textarea>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="quantity" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Jumlah *</label>
                                        <input wire:model.live="quantity" name="quantity" autocomplete="off" type="number" min="1" id="quantity" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <div class="flex flex-col justify-end">
                                        <?php
                                            $selectedProduct = $products->firstWhere('id', $product_id);
                                            $calculatedTotal = $selectedProduct
                                                ? $selectedProduct->price * max((int) $quantity, 1)
                                                : 0;
                                        ?>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Perkiraan total</p>
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                            Rp <?php echo e(number_format($calculatedTotal, 0, ',', '.')); ?>

                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="payment_method" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Metode Pembayaran *</label>
                                        <select wire:model="payment_method" name="payment_method" id="payment_method" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $paymentMethodOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>"><?php echo e($label); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </select>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Catatan</label>
                                    <textarea wire:model="notes" name="notes" autocomplete="off" id="notes" rows="3" class="mt-1 block w-full rounded-xl border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500" placeholder="Catatan tambahan untuk order"></textarea>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm font-semibold"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                            </div>
                        </form>
                    </div>

                    <!-- Card Footer -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end gap-3">
                        <a href="<?php echo e(route('orders.index')); ?>" class="inline-flex items-center px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                            Batal
                        </a>
                        <button type="submit" form="orderForm" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/orders/create.blade.php ENDPATH**/ ?>