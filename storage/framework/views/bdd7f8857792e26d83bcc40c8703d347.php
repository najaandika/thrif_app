<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Produk · Thrif Studio</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="midtrans-snap-token" content="<?php echo e($snapToken); ?>">
    <script>
        (function() {
            try {
                const stored = localStorage.getItem('darkMode');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (stored === 'true' || (stored === null && prefersDark)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
        })();
    </script>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/landing.css', 'resources/js/app.js', 'resources/js/landing-checkout.js']); ?>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo e(config('services.midtrans.client_key')); ?>">
    </script>
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900 font-sans">
    <div class="min-h-screen">
        <header class="bg-white/80 dark:bg-gray-900/80 border-b border-gray-200 dark:border-gray-800 backdrop-blur">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-end">
                <nav class="text-xs font-medium text-gray-600 dark:text-gray-300 flex items-center gap-3">
                    <a href="/" class="hover:text-slate-900 dark:hover:text-slate-100 inline-flex items-center gap-1">
                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Home
                    </a>
                    <span class="text-gray-300 dark:text-gray-700">•</span>
                    <span class="text-gray-400 cursor-not-allowed">Checkout</span>
                </nav>
            </div>
        </header>

        <main class="py-10">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                

                <?php if($errors->order->any()): ?>
                    <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 rounded-2xl border-2 border-red-300 dark:border-red-700 bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-950/40 dark:to-pink-950/40 px-5 py-4 flex items-start gap-4 shadow-lg shadow-red-500/20">
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-red-600 to-pink-600 flex items-center justify-center text-white shadow-lg shadow-red-500/50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-semibold tracking-wide text-red-600 dark:text-red-400 uppercase mb-1">Error</p>
                            <p class="text-sm font-medium text-red-900 dark:text-red-100"><?php echo e($errors->order->first()); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="grid gap-6 lg:grid-cols-[0.85fr,1.15fr]">
                    <?php echo $__env->make('landing.sections.checkout.product-info', ['product' => $product, 'labelClass' => $labelClass], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-6">
                        <div class="space-y-1">
                            <p class="<?php echo e($labelClass); ?>">Form Pembelian</p>
                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Isi data pengirimanmu</h2>
                        </div>

                        <form method="POST" action="<?php echo e(route('landing.products.order', $product)); ?>" class="space-y-6" id="checkout-form"
                              x-data="checkoutFormData({
                                  buyer_name: '<?php echo e($prefill['buyer_name'] ?? ''); ?>',
                                  buyer_contact: '<?php echo e($prefill['buyer_contact'] ?? ''); ?>',
                                  shipping_address: '<?php echo e($prefill['shipping_address'] ?? ''); ?>',
                                  notes: '<?php echo e($prefill['notes'] ?? ''); ?>'
                              })">
                            <?php echo csrf_field(); ?>
                            <div class="space-y-3">
                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pengiriman</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <label class="cursor-pointer relative">
                                            <input type="radio" name="delivery_type" value="shipping" x-model="deliveryMethod" class="peer sr-only">
                                            <div class="rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 peer-checked:border-slate-900 peer-checked:bg-slate-50 dark:peer-checked:border-slate-400 dark:peer-checked:bg-slate-900/50 transition-all text-center">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Pesan Antar</div>
                                                <div class="text-xs text-gray-500 mt-0.5">Kurir Toko (Balam) / Ekspedisi</div>
                                            </div>
                                        </label>
                                        <label class="cursor-pointer relative">
                                            <input type="radio" name="delivery_type" value="pickup" x-model="deliveryMethod" class="peer sr-only">
                                            <div class="rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 peer-checked:border-slate-900 peer-checked:bg-slate-50 dark:peer-checked:border-slate-400 dark:peer-checked:bg-slate-900/50 transition-all text-center">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Ambil di Toko</div>
                                                <div class="text-xs text-gray-500 mt-0.5">Gratis Ongkir</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pembayaran</label>
                                    <select name="payment_method" x-model="paymentMethod" class="<?php echo e($inputClass); ?>" required>
                                        <option value="cash" x-text="deliveryMethod === 'pickup' ? 'Bayar di Toko (Cash / QRIS)' : 'Cash On Delivery'"></option>
                                        <option value="midtrans">Midtrans (Transfer / QRIS)</option>
                                    </select>
                                </div>
                            
                            <!-- Hidden input to pass delivery type if needed by backend validation logic -->
                            
                            <div class="pt-2"></div>

                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 rounded-xl bg-slate-900 text-slate-100 dark:bg-slate-800 dark:text-slate-100 flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <p class="<?php echo e($labelClass); ?>">Data Pembeli</p>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['name' => 'buyer_name','label' => 'Nama penerima','xModel' => 'buyerName','required' => true,'autocomplete' => 'name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'buyer_name','label' => 'Nama penerima','x-model' => 'buyerName','required' => true,'autocomplete' => 'name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>

                                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['name' => 'buyer_contact','label' => 'Kontak (WA / IG)','xModel' => 'buyerContact','autocomplete' => 'tel']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'buyer_contact','label' => 'Kontak (WA / IG)','x-model' => 'buyerContact','autocomplete' => 'tel']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-emerald-500 to-green-500 flex items-center justify-center text-white">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="<?php echo e($labelClass); ?>">Detail Pengiriman</p>
                                </div>
                                
                                <!-- Address Section -->
                                <div x-show="deliveryMethod === 'shipping'" x-transition>
                                    <?php if (isset($component)) { $__componentOriginalcd97a59301ba78d56b3ed60dd41409ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.textarea','data' => ['name' => 'shipping_address','label' => 'Alamat pengiriman','xModel' => 'shippingAddress','rows' => 3,'placeholder' => 'Tulis alamat lengkap (Kecamatan & Kota wajib diisi untuk cek ongkir)',':required' => 'deliveryMethod === \'shipping\'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'shipping_address','label' => 'Alamat pengiriman','x-model' => 'shippingAddress','rows' => 3,'placeholder' => 'Tulis alamat lengkap (Kecamatan & Kota wajib diisi untuk cek ongkir)',':required' => 'deliveryMethod === \'shipping\'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab)): ?>
<?php $attributes = $__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab; ?>
<?php unset($__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd97a59301ba78d56b3ed60dd41409ab)): ?>
<?php $component = $__componentOriginalcd97a59301ba78d56b3ed60dd41409ab; ?>
<?php unset($__componentOriginalcd97a59301ba78d56b3ed60dd41409ab); ?>
<?php endif; ?>
                                </div>
                                
                                <!-- Shop Address Info when Pickup -->
                                <div x-show="deliveryMethod === 'pickup'" x-cloak class="rounded-2xl bg-slate-50 dark:bg-slate-900/50 p-4 border border-slate-200 dark:border-slate-700">
                                    <p class="text-xs font-semibold text-slate-500 uppercase mb-2">Lokasi Toko</p>
                                    <p class="font-medium text-gray-900 dark:text-gray-100 text-sm"><?php echo e($shopName); ?></p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1"><?php echo e($shopAddress); ?></p>
                                    <p class="text-xs text-gray-500 mt-2">Silakan ambil pesananmu langsung di toko kami.</p>
                                    
                                    <!-- Hidden input to fill address for backend validation -->
                                    <input type="hidden" name="pickup_address_note" value="AMBIL DI TOKO" :disabled="deliveryMethod !== 'pickup'">
                                </div>

                                <?php if (isset($component)) { $__componentOriginalcd97a59301ba78d56b3ed60dd41409ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.textarea','data' => ['name' => 'notes','label' => 'Catatan (Opsional)','xModel' => 'notes','rows' => 2,'placeholder' => 'Tambahkan catatan untuk pesanan ini...','value' => $prefill['notes'] ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'notes','label' => 'Catatan (Opsional)','x-model' => 'notes','rows' => 2,'placeholder' => 'Tambahkan catatan untuk pesanan ini...','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefill['notes'] ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab)): ?>
<?php $attributes = $__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab; ?>
<?php unset($__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd97a59301ba78d56b3ed60dd41409ab)): ?>
<?php $component = $__componentOriginalcd97a59301ba78d56b3ed60dd41409ab; ?>
<?php unset($__componentOriginalcd97a59301ba78d56b3ed60dd41409ab); ?>
<?php endif; ?>

                                <!-- Size Selector -->
                                <input type="hidden" name="size" value="<?php echo e($product->size); ?>" required>
                                <?php $__errorArgs = ['size', 'order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-xs text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <div class="grid gap-4 sm:grid-cols-2">

                                </div>
                            </div>

                            <div class="space-y-3">
                                    <?php echo $__env->make('landing.components.order-summary', ['product' => $product, 'prefilledQuantity' => $prefilledQuantity], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center gap-3 pt-1">
                                <button type="submit" id="submit-order-btn" aria-live="polite" class="inline-flex items-center justify-center gap-2 flex-1 rounded-2xl bg-gray-800 px-6 py-3.5 text-sm font-semibold text-white shadow-xl shadow-gray-900/40 transition-all duration-300 hover:bg-gray-700 hover:scale-105 hover:shadow-2xl hover:shadow-gray-900/60 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                                    <svg class="w-5 h-5 submit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <svg class="w-5 h-5 loading-spinner hidden animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="submit-text">Kirim Order</span>
                                </button>
                                <a href="/" class="inline-flex items-center justify-center gap-2 rounded-2xl border-2 border-gray-200 dark:border-gray-700 px-5 py-3.5 text-sm font-semibold text-gray-700 dark:text-gray-100 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 dark:hover:border-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batalkan
                                </a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <?php if (isset($component)) { $__componentOriginal7cfab914afdd05940201ca0b2cbc009b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $attributes = $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $component = $__componentOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>
    
    <?php if(session('status')): ?>
        <div data-checkout-status="<?php echo e(session('status')); ?>" data-checkout-redirect="<?php echo e(route('landing.orders.history')); ?>" style="display:none;"></div>
    <?php endif; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\thrif\resources\views/landing/checkout.blade.php ENDPATH**/ ?>