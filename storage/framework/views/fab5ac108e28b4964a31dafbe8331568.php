<div class="settings-wrapper">
    <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
        <div class="alert-container">
            <div class="alert-message">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold"><?php echo e(session('message')); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <div class="settings-layout">
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
        <div class="settings-content">
            <div class="settings-card">
                <div class="settings-card-body">
                    <div class="settings-header">
                        <h2 class="settings-title">Settings</h2>
                        <p class="settings-subtitle">Kelola informasi toko dan branding.</p>
                    </div>
                    <div class="tab-navigation">
                            <div class="flex space-x-2 mb-6">
                                    <button type="button" wire:click="$set('activeTab', 'shop')" class="px-4 py-2 rounded-xl font-semibold text-sm text-gray-700 dark:text-white focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"
                                        :class="$activeTab === 'shop' ? 'bg-slate-700' : 'bg-transparent hover:bg-slate-800'">
                                        Informasi Toko
                                    </button>
                                    <button type="button" wire:click="$set('activeTab', 'social')" class="px-4 py-2 rounded-xl font-semibold text-sm text-gray-700 dark:text-white focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"
                                        :class="$activeTab === 'social' ? 'bg-slate-700' : 'bg-transparent hover:bg-slate-800'">
                                        Social Media
                                    </button>
                                    <button type="button" wire:click="$set('activeTab', 'operational')" class="px-4 py-2 rounded-xl font-semibold text-sm text-gray-700 dark:text-white focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"
                                        :class="$activeTab === 'operational' ? 'bg-slate-700' : 'bg-transparent hover:bg-slate-800'">
                                        Operasional
                                    </button>
                                    <button type="button" wire:click="$set('activeTab', 'about')" class="px-4 py-2 rounded-xl font-semibold text-sm text-gray-700 dark:text-white focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"
                                        :class="$activeTab === 'about' ? 'bg-slate-700' : 'bg-transparent hover:bg-slate-800'">
                                        Tentang Kami
                                    </button>
                            </div>
                    </div>
                    <form wire:submit="save" class="settings-form">
                        <!--[if BLOCK]><![endif]--><?php if($activeTab === 'shop'): ?>
                            <?php echo $__env->make('livewire.settings.shop', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php elseif($activeTab === 'social'): ?>
                            <?php echo $__env->make('livewire.settings.social', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php elseif($activeTab === 'operational'): ?>
                            <?php echo $__env->make('livewire.settings.operational', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php elseif($activeTab === 'about'): ?>
                            <?php echo $__env->make('livewire.settings.about', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="submit-section">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-slate-700 hover:bg-slate-800 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider transition-all shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    SIMPAN PERUBAHAN
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\thrif\resources\views/livewire/settings/index.blade.php ENDPATH**/ ?>