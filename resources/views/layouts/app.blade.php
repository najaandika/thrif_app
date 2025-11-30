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

        <!-- Dark mode pre-init to avoid flash -->
        <script>
            (function() {
                try {
                    const stored = localStorage.getItem('darkMode');
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    const isDark = stored === 'true' || (stored === null && prefersDark);
                    
                    // Set background color immediately to prevent flicker
                    if (isDark) {
                        document.documentElement.style.backgroundColor = 'rgb(17 24 39)';
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.style.backgroundColor = 'rgb(243 244 246)';
                        document.documentElement.classList.remove('dark');
                    }
                } catch (e) {}
            })();
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <style>
            html, body { touch-action: pan-x pan-y; overscroll-behavior: none; overflow-x: hidden; }
            
            /* Smooth transition for Livewire navigation */
            body {
                transition: opacity 0.15s ease-in-out;
            }
        </style>
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
        <script>
            // Configure Livewire to reduce flicker
            document.addEventListener('livewire:init', () => {
                Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
                    succeed(({ snapshot, effect }) => {
                        // Smooth transition
                        document.body.style.opacity = '0.95';
                        setTimeout(() => {
                            document.body.style.opacity = '1';
                        }, 50);
                    });
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        // SweetAlert2 Configuration
        const swalConfig = {
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            width: '320px',
            padding: '1rem',
            customClass: {
                popup: 'swal-compact',
                title: 'swal-title-compact',
                htmlContainer: 'swal-text-compact',
                confirmButton: 'swal-btn-compact',
                cancelButton: 'swal-btn-compact'
            }
        };

        // Generic delete confirmation helper
        function showDeleteConfirmation(id, title, eventName) {
            Swal.fire({
                ...swalConfig,
                title: title,
                text: 'Data yang dihapus tidak bisa dikembalikan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.Livewire.dispatch(eventName, [id]);
                }
            });
        }

        // Delete confirmation for Orders
        function confirmDelete(id) {
            showDeleteConfirmation(id, 'Yakin hapus data ini?', 'delete');
        }

        // Delete confirmation for Transactions
        function confirmDeleteTransaction(id) {
            showDeleteConfirmation(id, 'Yakin hapus transaksi ini?', 'deleteTransaction');
        }

        // Expose functions globally
        window.confirmDelete = confirmDelete;
        window.confirmDeleteTransaction = confirmDeleteTransaction;
        </script>
        <style>
        .swal-compact {
            padding: 1rem !important;
            border-radius: 0.75rem !important;
        }
        .swal-title-compact {
            font-size: 1rem !important;
            font-weight: 600 !important;
            padding: 0.25rem 0 !important;
            margin: 0 !important;
        }
        .swal-text-compact {
            font-size: 0.75rem !important;
            padding: 0.25rem 0 0.75rem 0 !important;
            margin: 0 !important;
        }
        .swal2-icon {
            width: 3rem !important;
            height: 3rem !important;
            margin: 0.5rem auto 0.5rem !important;
            border-width: 3px !important;
        }
        .swal2-icon .swal2-icon-content {
            font-size: 2rem !important;
        }
        .swal2-actions {
            margin: 0.75rem 0 0 0 !important;
            gap: 0.5rem !important;
        }
        .swal-btn-compact {
            font-size: 0.813rem !important;
            padding: 0.5rem 1rem !important;
            min-width: auto !important;
        }
        @media (max-width: 640px) {
            .swal-compact {
                width: 90% !important;
                max-width: 300px !important;
            }
        }
        </style>
    </body>
</html>
