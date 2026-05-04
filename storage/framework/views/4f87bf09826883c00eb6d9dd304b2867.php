<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'Profile', 'breadcrumb' => null]));

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

foreach (array_filter((['title' => 'Profile', 'breadcrumb' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $homeUrl = auth()->user()?->homePath() ?? url('/');
?>

<?php if (isset($component)) { $__componentOriginal250b6dc2a6033c0bc047c15a0d0571e1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal250b6dc2a6033c0bc047c15a0d0571e1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.clean-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('clean-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <?php echo e($title); ?>

                </h2>
                <?php if($breadcrumb): ?>
                    <nav class="hidden md:flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <a href="<?php echo e(route('profile')); ?>" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Profile</a>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-900 dark:text-gray-100 font-medium"><?php echo e($breadcrumb); ?></span>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="py-8 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a
                    href="<?php echo e(route('profile')); ?>"
                    class="inline-flex items-center gap-2 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm transition-all duration-300 hover:border-slate-400 dark:hover:border-slate-500 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-slate-500"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5" />
                        <path d="M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Content -->
            <div class="space-y-6">
                <?php echo e($slot); ?>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal250b6dc2a6033c0bc047c15a0d0571e1)): ?>
<?php $attributes = $__attributesOriginal250b6dc2a6033c0bc047c15a0d0571e1; ?>
<?php unset($__attributesOriginal250b6dc2a6033c0bc047c15a0d0571e1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal250b6dc2a6033c0bc047c15a0d0571e1)): ?>
<?php $component = $__componentOriginal250b6dc2a6033c0bc047c15a0d0571e1; ?>
<?php unset($__componentOriginal250b6dc2a6033c0bc047c15a0d0571e1); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\thrif\resources\views\components\profile\standalone-layout.blade.php ENDPATH**/ ?>