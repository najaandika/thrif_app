<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-950">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(15,23,42,0.04),transparent_32rem)]">
        <div class="flex min-h-screen">
            <x-sidebar />
            <main class="min-w-0 flex-1">
            {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus data ini?',
            html: '<p class="swal-delete-copy">Data akan dihapus permanen dan tidak bisa dikembalikan.</p>',
            iconHtml: '<span class="swal-delete-mark">!</span>',
            showCancelButton: true,
            reverseButtons: true,
            focusCancel: true,
            buttonsStyling: false,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'swal-admin-popup',
                icon: 'swal-admin-icon',
                title: 'swal-admin-title',
                htmlContainer: 'swal-admin-html',
                actions: 'swal-admin-actions',
                confirmButton: 'swal-admin-confirm-danger',
                cancelButton: 'swal-admin-cancel',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                if (typeof Livewire !== 'undefined') {
                    Livewire.emit('delete', id);
                } else if (window.livewire) {
                    window.livewire.emit('delete', id);
                }
            }
        });
    }
    window.confirmDelete = confirmDelete;
    </script>
</body>
</html>

