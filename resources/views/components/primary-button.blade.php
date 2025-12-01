<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-slate-900 to-slate-700 hover:from-slate-800 hover:to-slate-600 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg shadow-slate-900/40 dark:shadow-slate-900/30 hover:shadow-xl hover:shadow-slate-900/60 hover:scale-105 active:scale-95 focus:outline-none focus:ring-4 focus:ring-slate-500/60 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 transition-all duration-200']) }}>
    {{ $slot }}
</button>

