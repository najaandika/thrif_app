<div wire:poll.5s>
    <?php echo $__env->make('components.sidebar.menu', ['pendingOrdersCount' => $this->pendingOrdersCount, 'mobile' => $mobile ?? false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/sidebar/menu.blade.php ENDPATH**/ ?>