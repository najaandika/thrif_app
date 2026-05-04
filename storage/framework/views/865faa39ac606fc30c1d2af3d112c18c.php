<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Profile')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[260px_1fr]">
                <aside>
                    <?php if (isset($component)) { $__componentOriginal01bf3b01a557c75eb9cd135a2177f1b0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01bf3b01a557c75eb9cd135a2177f1b0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01bf3b01a557c75eb9cd135a2177f1b0)): ?>
<?php $attributes = $__attributesOriginal01bf3b01a557c75eb9cd135a2177f1b0; ?>
<?php unset($__attributesOriginal01bf3b01a557c75eb9cd135a2177f1b0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01bf3b01a557c75eb9cd135a2177f1b0)): ?>
<?php $component = $__componentOriginal01bf3b01a557c75eb9cd135a2177f1b0; ?>
<?php unset($__componentOriginal01bf3b01a557c75eb9cd135a2177f1b0); ?>
<?php endif; ?>
                </aside>

                <div class="space-y-6">
                    <section id="section-account" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl space-y-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Profil</p>
                            <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Informasi Akun</h3>
                        </div>
                        <div class="space-y-6">
                            <div class="max-w-xl">
                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.update-profile-information-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2399689974-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                            </div>
                            <div class="max-w-xl">
                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.update-password-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2399689974-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                            </div>
                        </div>
                    </section>

                    <section id="section-address" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Alamat</p>
                                <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Alamat Pengiriman</h3>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Fitur alamat khusus segera hadir. Untuk sementara, cantumkan alamat saat membuat order.</p>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">Coming soon</span>
                        </div>
                    </section>

                    <?php if(auth()->user()?->isCustomer()): ?>
                        <section id="section-history" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.order-history', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2399689974-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        </section>
                    <?php endif; ?>

                    <section id="section-wishlist" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Favorit</p>
                            <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Wishlist</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada item favorit. Tandai produk favorit pada halaman detail produk untuk melihatnya di sini.</p>
                        </div>
                    </section>

                    <section id="section-logout" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Keluar</p>
                                <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Akhiri sesi</h3>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Pastikan sudah menyimpan perubahan sebelum keluar dari akun.</p>
                            </div>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="inline-flex items-center px-5 py-3 rounded-xl bg-red-600 text-white font-semibold shadow hover:bg-red-700 transition">Keluar</button>
                            </form>
                        </div>
                    </section>

                    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                        <div class="max-w-xl">
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.delete-user-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2399689974-3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('orders.customer-receipt-modal');

$__html = app('livewire')->mount($__name, $__params, 'lw-2399689974-4', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\thrif\resources\views\profile.blade.php ENDPATH**/ ?>