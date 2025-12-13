<div class="h-full rounded-3xl border border-slate-300/80 dark:border-slate-700 bg-gradient-to-br from-slate-600 via-slate-700 to-slate-800/95 dark:from-slate-900/95 dark:via-slate-800/95 dark:to-slate-800/90 p-5 sm:p-6 space-y-4 relative overflow-hidden" id="tentang-kami" data-section="about">
    <!-- Decorative element -->
    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-gradient-to-br from-indigo-500/10 to-purple-500/10 blur-2xl"></div>
    
    <div class="space-y-3 relative z-10">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-xl bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-100 shadow-lg shadow-slate-950/40">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold tracking-[0.2em] text-slate-300 uppercase">Tentang</p>
            </div>
        </div>
    </div>
    
    <div class="space-y-3 relative z-10">
        <div class="flex gap-3">
            <div class="flex-shrink-0 mt-1">
                <div class="h-6 w-6 rounded-lg bg-slate-800/80 flex items-center justify-center">
                    <svg class="w-3 h-3 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <p class="text-[13px] text-slate-200/90 leading-relaxed">
                <?php echo e($aboutDescription); ?>

            </p>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-2.5 pt-1.5 relative z-10">
        <?php if($aboutFeature1): ?>
        <div class="inline-flex items-center gap-1.5 rounded-full bg-slate-900/80 border border-slate-700 px-3.5 py-1.5 text-[11px] font-medium text-slate-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" class="text-emerald-400"></path>
            </svg>
            <?php echo e($aboutFeature1); ?>

        </div>
        <?php endif; ?>
        
        <?php if($aboutFeature2): ?>
        <div class="inline-flex items-center gap-1.5 rounded-full bg-slate-900/80 border border-slate-700 px-3.5 py-1.5 text-[11px] font-medium text-slate-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <?php echo e($aboutFeature2); ?>

        </div>
        <?php endif; ?>
        
        <?php if($aboutFeature3): ?>
        <div class="inline-flex items-center gap-1.5 rounded-full bg-slate-900/80 border border-slate-700 px-3.5 py-1.5 text-[11px] font-medium text-slate-100">
            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            <?php echo e($aboutFeature3); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/landing/sections/about.blade.php ENDPATH**/ ?>