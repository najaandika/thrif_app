@props([
    'message' => null,
    'type' => 'success', // success, error, warning, info
    'autoHide' => true,
    'timeout' => 4000,
])

@if ($message)
    @php
        $config = [
            'success' => [
                'bg' => 'from-green-50 to-emerald-50 dark:from-green-900 dark:to-emerald-900',
                'text' => 'text-green-700 dark:text-green-200',
                'border' => 'border-green-500',
                'icon' => 'M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z',
            ],
            'error' => [
                'bg' => 'from-red-50 to-rose-50 dark:from-red-900 dark:to-rose-900',
                'text' => 'text-red-700 dark:text-red-200',
                'border' => 'border-red-500',
                'icon' => 'M10 18a8 8 0 100-16 8 8 0 000 16zm-1-5h2v2H9v-2zm0-4h2v3H9V9z',
            ],
            'warning' => [
                'bg' => 'from-yellow-50 to-amber-50 dark:from-yellow-900 dark:to-amber-900',
                'text' => 'text-yellow-800 dark:text-yellow-100',
                'border' => 'border-yellow-500',
                'icon' => 'M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92C18.856 14.879 18.074 16 16.837 16H3.163c-1.237 0-2.019-1.121-1.486-2.981l5.58-9.92z',
            ],
            'info' => [
                'bg' => 'from-blue-50 to-sky-50 dark:from-blue-900 dark:to-sky-900',
                'text' => 'text-blue-700 dark:text-blue-200',
                'border' => 'border-blue-500',
                'icon' => 'M10 18a8 8 0 100-16 8 8 0 000 16zm1-11H9v2h2V7zm0 4H9v4h2v-4z',
            ],
        ][$type] ?? $config['success'];
    @endphp

    <div
        @if($autoHide)
            x-data
            x-init="setTimeout(() => $el.remove(), {{ (int) $timeout }});"
        @endif
        class="mb-6 p-4 bg-gradient-to-r {{ $config['bg'] }} {{ $config['text'] }} rounded-xl border-l-4 {{ $config['border'] }} shadow-lg flex items-start justify-between gap-3"
    >
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="{{ $config['icon'] }}" clip-rule="evenodd"></path>
            </svg>
            <div class="text-sm font-medium">
                {{ $message }}
            </div>
        </div>

        <button type="button" class="text-xs opacity-60 hover:opacity-100" @if($autoHide) x-on:click="$el.closest('div').remove()" @endif>
            Tutup
        </button>
    </div>
@endif

