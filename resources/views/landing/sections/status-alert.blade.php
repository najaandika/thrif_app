@if (session('status'))
    <div class="mb-6 rounded-2xl border-2 border-emerald-300 dark:border-emerald-700 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-950/40 dark:to-green-950/40 px-5 py-4 flex items-start gap-4 shadow-lg shadow-emerald-500/20 animate-slideIn">
        <div class="flex-shrink-0 mt-0.5">
            <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-emerald-600 to-green-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>
        <div class="flex-1">
            <p class="text-xs font-semibold tracking-wide text-emerald-600 dark:text-emerald-400 uppercase mb-1">Success</p>
            <p class="text-sm font-medium text-emerald-900 dark:text-emerald-100">{{ session('status') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="flex-shrink-0 text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-200 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="mb-6 rounded-2xl border-2 border-red-300 dark:border-red-700 bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-950/40 dark:to-pink-950/40 px-5 py-4 flex items-start gap-4 shadow-lg shadow-red-500/20 animate-slideIn">
        <div class="flex-shrink-0 mt-0.5">
            <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-red-600 to-pink-600 flex items-center justify-center text-white shadow-lg shadow-red-500/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        </div>
        <div class="flex-1">
            <p class="text-xs font-semibold tracking-wide text-red-600 dark:text-red-400 uppercase mb-1">Error</p>
            <p class="text-sm font-medium text-red-900 dark:text-red-100">{{ session('error') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="flex-shrink-0 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

<style>
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-1rem);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-slideIn {
    animation: slideIn 0.3s ease-out;
}
</style>

