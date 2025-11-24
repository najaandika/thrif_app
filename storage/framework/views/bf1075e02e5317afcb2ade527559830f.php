<!-- Toast Container -->
<div id="toast-container" class="fixed top-20 right-4 z-[60] space-y-3 pointer-events-none">
    <!-- Toasts will be dynamically inserted here -->
</div>

<script>
    // Toast notification system
    window.showToast = function(message, type = 'success', duration = 3000) {
        const container = document.getElementById('toast-container');
        if (!container) return;
        
        const toastId = 'toast-' + Date.now();
        const icons = {
            success: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
            error: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
            info: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            warning: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>'
        };
        
        const colors = {
            success: 'from-emerald-600 to-green-600',
            error: 'from-red-600 to-pink-600',
            info: 'from-indigo-600 to-purple-600',
            warning: 'from-amber-600 to-orange-600'
        };
        
        const bgColors = {
            success: 'from-emerald-50 to-green-50 dark:from-emerald-950/40 dark:to-green-950/40 border-emerald-300 dark:border-emerald-700',
            error: 'from-red-50 to-pink-50 dark:from-red-950/40 dark:to-pink-950/40 border-red-300 dark:border-red-700',
            info: 'from-indigo-50 to-purple-50 dark:from-indigo-950/40 dark:to-purple-950/40 border-indigo-300 dark:border-indigo-700',
            warning: 'from-amber-50 to-orange-50 dark:from-amber-950/40 dark:to-orange-950/40 border-amber-300 dark:border-amber-700'
        };
        
        const textColors = {
            success: 'text-emerald-600 dark:text-emerald-400',
            error: 'text-red-600 dark:text-red-400',
            info: 'text-indigo-600 dark:text-indigo-400',
            warning: 'text-amber-600 dark:text-amber-400'
        };
        
        const toastHTML = `
            <div id="${toastId}" class="pointer-events-auto max-w-sm w-full bg-gradient-to-r ${bgColors[type]} border-2 rounded-2xl shadow-xl overflow-hidden transform translate-x-full transition-transform duration-300 ease-out">
                <div class="p-4 flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <div class="h-8 w-8 rounded-xl bg-gradient-to-br ${colors[type]} flex items-center justify-center text-white shadow-lg">
                            ${icons[type]}
                        </div>
                    </div>
                    <div class="flex-1 pt-0.5">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">${message}</p>
                    </div>
                    <button onclick="window.removeToast('${toastId}')" class="flex-shrink-0 ${textColors[type]} hover:opacity-70 transition-opacity">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', toastHTML);
        
        const toast = document.getElementById(toastId);
        
        // Slide in animation
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
            toast.classList.add('translate-x-0');
        }, 10);
        
        // Auto remove
        setTimeout(() => {
            window.removeToast(toastId);
        }, duration);
    };
    
    window.removeToast = function(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    };
</script>
<?php /**PATH C:\laragon\www\thrif\resources\views/components/toast.blade.php ENDPATH**/ ?>