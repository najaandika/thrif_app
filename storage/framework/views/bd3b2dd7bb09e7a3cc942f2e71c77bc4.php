<?php if(session()->has('success')): ?>
    <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/40 dark:to-emerald-900/40 text-green-700 dark:text-green-200 border-l-4 border-green-500 shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-semibold"><?php echo e(session('success')); ?></span>
        </div>
    </div>
<?php endif; ?>

<?php if(session()->has('error')): ?>
    <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/40 dark:to-pink-900/40 text-red-700 dark:text-red-200 border-l-4 border-red-500 shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-semibold"><?php echo e(session('error')); ?></span>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\laragon\www\thrif\resources\views\livewire\pos\_alerts.blade.php ENDPATH**/ ?>