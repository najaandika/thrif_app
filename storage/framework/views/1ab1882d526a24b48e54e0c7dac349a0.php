<div class="py-12">
    <div class="flex flex-row gap-6">
        <?php if (isset($component)) { $__componentOriginal2880b66d47486b4bfeaf519598a469d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2880b66d47486b4bfeaf519598a469d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $attributes = $__attributesOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $component = $__componentOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__componentOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>
        
        <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-6xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <!-- Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">POS (Kasir Offline)</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola transaksi penjualan offline</p>
                    </div>

                    <?php echo $__env->make('livewire.pos._alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <form wire:submit.prevent="saveTransaction">
                        <div class="flex flex-col lg:flex-row gap-6">
                            <?php echo $__env->make('livewire.pos._product-panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php echo $__env->make('livewire.pos._cart-and-payment', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $__env->make('livewire.orders._modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <style>
        div.swal2-popup.swal-mobile-compact {
            width: 280px !important;
            padding: 1rem !important;
        }
        div.swal2-popup.swal-mobile-compact .swal2-title {
            font-size: 16px !important;
        }
        div.swal2-popup.swal-mobile-compact .swal2-html-container {
            font-size: 13px !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-pos-success', (event) => {
                Swal.fire({
                    title: 'Sukses!',
                    text: event.message,
                    imageUrl: "<?php echo e(asset('images/success-icon.svg')); ?>",
                    imageWidth: 50,
                    imageHeight: 50,
                    imageAlt: 'Success',
                    showDenyButton: true,
                    confirmButtonText: 'OK (Transaksi Baru)',
                    denyButtonText: 'Cetak Struk',
                    confirmButtonColor: '#10b981',
                    denyButtonColor: '#3b82f6',
                    width: '300px',
                    padding: '1.25rem',
                    customClass: {
                        popup: 'rounded-2xl swal-mobile-compact',
                        confirmButton: 'rounded-lg px-4 py-2 text-xs font-semibold',
                        denyButton: 'rounded-lg px-4 py-2 text-xs font-semibold',
                        title: 'font-bold',
                        htmlContainer: 'text-sm'
                    }
                }).then((result) => {
                    if (result.isDenied) {
                        // Trigger show receipt modal
                         window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('showLastReceipt', event.orderId);
                    }
                });
            });
        });
    </script>
</div><?php /**PATH C:\laragon\www\thrif\resources\views\livewire\pos\index.blade.php ENDPATH**/ ?>