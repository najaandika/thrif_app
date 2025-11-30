<?php if (isset($component)) { $__componentOriginal84ccc2bf529643f4f8d478c2cc563f4e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84ccc2bf529643f4f8d478c2cc563f4e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile.standalone-layout','data' => ['title' => 'Riwayat Pembelian','breadcrumb' => 'Riwayat']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile.standalone-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Riwayat Pembelian','breadcrumb' => 'Riwayat']); ?>
    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.order-history', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2972915299-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal84ccc2bf529643f4f8d478c2cc563f4e)): ?>
<?php $attributes = $__attributesOriginal84ccc2bf529643f4f8d478c2cc563f4e; ?>
<?php unset($__attributesOriginal84ccc2bf529643f4f8d478c2cc563f4e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal84ccc2bf529643f4f8d478c2cc563f4e)): ?>
<?php $component = $__componentOriginal84ccc2bf529643f4f8d478c2cc563f4e; ?>
<?php unset($__componentOriginal84ccc2bf529643f4f8d478c2cc563f4e); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\thrif\resources\views/profile/history.blade.php ENDPATH**/ ?>