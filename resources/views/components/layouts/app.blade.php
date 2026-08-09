<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#f3f4f6">
    <!-- Dark Mode Script (Prevent FOUC) -->
    <style>
        [x-cloak] { display: none !important; }
        html.dark body { background-color: #111827 !important; }
        html:not(.dark) body { background-color: #f3f4f6 !important; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen">
        <livewire:layout.navigation />
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        @php
            $showAdminSidebar = request()->routeIs([
                'dashboard',
                'pos.*',
                'orders.*',
                'products.*',
                'categories.*',
                'promotions.*',
                'customers.*',
                'reports.*',
                'transactions.*',
                'settings.*',
            ]);
        @endphp

        <div class="{{ $showAdminSidebar ? 'flex min-h-[calc(100vh-4rem)]' : '' }}">
            @if($showAdminSidebar)
                <x-sidebar />
            @endif

            <main class="{{ $showAdminSidebar ? 'min-w-0 flex-1' : '' }}">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>

