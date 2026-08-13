<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <!-- Flatpickr for Date Inputs -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        @livewireStyles
        <!-- CSS swal dan body dipindah ke app.css -->
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900" style="transition:none;">
            <livewire:layout.navigation />

            <!-- Page Heading -->
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

            <!-- Page Content -->
            <div
                @if($showAdminSidebar)
                    x-data="{
                        collapsed: localStorage.getItem('adminSidebarCollapsed') === 'true',
                        toggleSidebar() {
                            this.collapsed = ! this.collapsed;
                            localStorage.setItem('adminSidebarCollapsed', this.collapsed ? 'true' : 'false');
                        }
                    }"
                    x-bind:class="collapsed ? 'admin-sidebar-collapsed' : ''"
                @endif
                class="{{ $showAdminSidebar ? 'flex min-h-[calc(100vh-4rem)]' : '' }}"
            >
                @if($showAdminSidebar)
                    <x-sidebar />
                @endif

                <main class="{{ $showAdminSidebar ? 'min-w-0 flex-1' : '' }}">
                    @isset($slot)
                        {{-- Livewire components with #[Layout()] attribute use $slot --}}
                        {{ $slot }}
                    @else
                        {{-- Traditional Blade views with @extends use @yield --}}
                        @yield('content')
                    @endisset
                </main>
            </div>
        </div>
        @livewireScripts
        @vite(['resources/js/swal.js'])
    </body>
</html>
