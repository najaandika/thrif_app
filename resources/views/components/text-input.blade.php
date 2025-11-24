@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/30 dark:focus:ring-indigo-600/30 rounded-lg shadow-sm transition-all duration-200']) }}>
