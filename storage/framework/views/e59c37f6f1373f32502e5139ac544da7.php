<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['mobile' => false, 'pendingOrdersCount' => 0]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['mobile' => false, 'pendingOrdersCount' => 0]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $activeClasses = 'bg-gray-900 text-white dark:bg-gray-100 dark:text-gray-900 shadow-md';
    $inactiveClasses = 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700';
?>

<div class="<?php echo e($mobile ? 'p-4' : ''); ?>">
    <!--[if BLOCK]><![endif]--><?php if($mobile): ?>
    <div class="rounded-2xl shadow-sm border overflow-hidden w-fit" 
         style="background-color: rgb(31 41 55); border-color: rgb(55 65 81);"
         x-effect="$el.style.backgroundColor = $store.darkMode.on ? 'rgb(31 41 55)' : 'rgb(255 255 255)'; $el.style.borderColor = $store.darkMode.on ? 'rgb(55 65 81)' : 'rgb(243 244 246)'">
        <div class="p-4">
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2 px-2">Menu</p>

    <nav class="space-y-1">
        <a href="<?php echo e(route('dashboard')); ?>" <?php if($mobile): ?> wire:navigate.stop @click="$dispatch('close-drawer')" <?php endif; ?> class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('dashboard') || request()->is('dashboard') ? $activeClasses : $inactiveClasses); ?>">
            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
        </a>

        <a href="<?php echo e(route('pos.index')); ?>" <?php if($mobile): ?> wire:navigate.stop @click="$dispatch('close-drawer')" <?php endif; ?> class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('pos.*') ? $activeClasses : $inactiveClasses); ?>">
            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="9" cy="21" r="1" />
                <circle cx="20" cy="21" r="1" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6" />
            </svg>
            POS
        </a>

        <a href="<?php echo e(route('transactions.index')); ?>" <?php if($mobile): ?> wire:navigate.stop @click="$dispatch('close-drawer')" <?php endif; ?> class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('transactions.*') ? $activeClasses : $inactiveClasses); ?>">
            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="16" rx="2" ry="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <line x1="8" y1="9" x2="16" y2="9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <line x1="8" y1="13" x2="16" y2="13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Transaksi
        </a>

        <a href="<?php echo e(route('orders.index')); ?>" <?php if($mobile): ?> wire:navigate.stop @click="$dispatch('close-drawer')" <?php endif; ?> class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('orders.*') ? $activeClasses : $inactiveClasses); ?>">
            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 8h18M3 13h18M3 18h18"></path>
            </svg>
            <span class="flex-1">Pesanan</span>

            <!--[if BLOCK]><![endif]--><?php if($pendingOrdersCount > 0): ?>
                <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold rounded-full bg-red-500 text-white">
                    <?php echo e($pendingOrdersCount); ?>

                </span>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </a>

        <a href="<?php echo e(route('products.index')); ?>" <?php if($mobile): ?> wire:navigate.stop @click="$dispatch('close-drawer')" <?php endif; ?> class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('products.*') ? $activeClasses : $inactiveClasses); ?>">
            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Produk
        </a>

        <a href="<?php echo e(route('categories.index')); ?>" <?php if($mobile): ?> wire:navigate.stop @click="$dispatch('close-drawer')" <?php endif; ?> class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('categories.*') ? $activeClasses : $inactiveClasses); ?>">
            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            Kategori
        </a>
 

        <a href="<?php echo e(route('settings.index')); ?>" <?php if($mobile): ?> wire:navigate.stop @click="$dispatch('close-drawer')" <?php endif; ?> class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('settings.*') ? $activeClasses : $inactiveClasses); ?>">
            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Pengaturan
        </a>
    </nav>

    <!--[if BLOCK]><![endif]--><?php if($mobile): ?>
        </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/components/sidebar/menu.blade.php ENDPATH**/ ?>