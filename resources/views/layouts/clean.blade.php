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

        <!-- Dark mode pre-init untuk mencegah flicker putih -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ajax-cart.js'])
        @livewireStyles
        <!-- CSS dihandle oleh app.css -->
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Content -->
            <main>
                @isset($slot)
                    {{-- Livewire components with #[Layout()] attribute use $slot --}}
                    {{ $slot }}
                @else
                    {{-- Traditional Blade views with @extends use @yield --}}
                    @yield('content')
                @endisset
            </main>
        </div>
        @livewireScripts
    </body>
</html>

