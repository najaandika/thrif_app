@props(['title' => 'Profile', 'breadcrumb' => null])

@php
    $homeUrl = auth()->user()?->homePath() ?? url('/');
@endphp

<x-clean-layout>
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $title }}
                </h2>
                @if($breadcrumb)
                    <nav class="hidden md:flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <a href="{{ route('profile') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Profile</a>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $breadcrumb }}</span>
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <div class="py-8 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a
                    href="{{ route('profile') }}"
                    class="inline-flex items-center gap-2 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm transition-all duration-300 hover:border-indigo-300 dark:hover:border-indigo-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5" />
                        <path d="M12 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Content -->
            <div class="space-y-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-clean-layout>
