<div class="hidden lg:flex lg:w-64 flex-shrink-0">
    <div class="sticky top-16 w-full px-3">
        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-md rounded-xl border border-gray-100 dark:border-gray-700 h-fit w-56">
            <div class="p-3 sm:p-4">
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
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/components/sidebar.blade.php ENDPATH**/ ?>