<?php if (isset($component)) { $__componentOriginal84ccc2bf529643f4f8d478c2cc563f4e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84ccc2bf529643f4f8d478c2cc563f4e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile.standalone-layout','data' => ['title' => 'Informasi Akun','breadcrumb' => 'Informasi Akun']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile.standalone-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Informasi Akun','breadcrumb' => 'Informasi Akun']); ?>
    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl space-y-6">
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

$__html = app('livewire')->mount($__name, $__params, 'lw-609896731-0', $__slots ?? [], get_defined_vars());

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

$__html = app('livewire')->mount($__name, $__params, 'lw-609896731-1', $__slots ?? [], get_defined_vars());

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

    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl">
        <div class="max-w-xl">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.delete-user-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-609896731-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
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
<?php /**PATH C:\laragon\www\thrif\resources\views\profile\info.blade.php ENDPATH**/ ?>