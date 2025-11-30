<?php if (isset($component)) { $__componentOriginal84ccc2bf529643f4f8d478c2cc563f4e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84ccc2bf529643f4f8d478c2cc563f4e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile.standalone-layout','data' => ['title' => 'Wishlist','breadcrumb' => 'Favorit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile.standalone-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Wishlist','breadcrumb' => 'Favorit']); ?>
    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Favorit</p>
            <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Wishlist</h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada item favorit. Tandai produk favorit pada halaman detail produk untuk melihatnya di sini.</p>
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
<?php /**PATH C:\laragon\www\thrif\resources\views/profile/wishlist.blade.php ENDPATH**/ ?>