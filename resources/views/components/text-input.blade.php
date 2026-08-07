@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-slate-600 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-500/30 dark:focus:ring-slate-500/30 rounded-lg shadow-sm transition-all duration-200']) }}>

