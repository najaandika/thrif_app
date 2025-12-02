<!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
    <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900 dark:to-emerald-900 text-green-700 dark:text-green-200 rounded-xl border-l-4 border-green-500 shadow-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-semibold"><?php echo e(session('message')); ?></span>
        </div>
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/orders/_flash.blade.php ENDPATH**/ ?>