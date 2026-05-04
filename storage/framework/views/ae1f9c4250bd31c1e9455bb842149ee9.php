<?php if (isset($component)) { $__componentOriginal84ccc2bf529643f4f8d478c2cc563f4e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84ccc2bf529643f4f8d478c2cc563f4e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile.standalone-layout','data' => ['title' => 'Alamat Pengiriman','breadcrumb' => 'Alamat']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile.standalone-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Alamat Pengiriman','breadcrumb' => 'Alamat']); ?>
    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl space-y-6">
        <header class="space-y-1">
            <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Alamat</p>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Alamat Pengiriman</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Gunakan form berikut untuk menyimpan alamat default sehingga checkout lebih cepat.</p>
        </header>

        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.address-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2380222961-0', $__slots ?? [], get_defined_vars());

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
<?php /**PATH C:\laragon\www\thrif\resources\views\profile\address.blade.php ENDPATH**/ ?>