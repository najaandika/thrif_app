<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" />

        <!-- Dark mode pre-init to avoid flash -->
        <script>
            document.body && (document.body.style.visibility = 'hidden');
            (function() {
                try {
                    const stored = localStorage.getItem('darkMode');
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (stored === 'true' || (stored === null && prefersDark)) {
                        document.documentElement.classList.add('dark');
                        document.body.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        document.body.classList.remove('dark');
                    }
                } catch (e) {}
                document.body && (document.body.style.visibility = 'visible');
            })();
        </script>

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

        <style>
            html, body { touch-action: pan-x pan-y; overscroll-behavior: none; overflow-x: hidden; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900" style="transition:none;">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('layout.navigation', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2200940470-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main>
                <?php if(isset($slot)): ?>
                    
                    <?php echo e($slot); ?>

                <?php else: ?>
                    
                    <?php echo $__env->yieldContent('content'); ?>
                <?php endif; ?>
            </main>
        </div>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: 'Data yang dihapus tidak bisa dikembalikan!',
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
            }).then((result) => {
                if (result.isConfirmed) {
                    // Livewire 3 dispatch - send id directly as parameter
                    window.Livewire.dispatch('delete', [id]);
                }
            });
        }
        window.confirmDelete = confirmDelete;
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
<?php /**PATH C:\laragon\www\thrif\resources\views/layouts/app.blade.php ENDPATH**/ ?>