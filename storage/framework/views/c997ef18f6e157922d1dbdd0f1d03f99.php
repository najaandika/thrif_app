<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <meta name="theme-color" content="#f3f4f6">
        <!-- Dark mode pre-init untuk mencegah flicker putih -->
        <script>
            try {
                const stored = localStorage.getItem('darkMode');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const isDark = stored === 'true' || (stored === null && prefersDark);
                
                const metaThemeColor = document.querySelector('meta[name="theme-color"]');

                if (isDark) {
                    document.documentElement.classList.add('dark');
                    document.documentElement.style.backgroundColor = '#111827';
                    if (metaThemeColor) metaThemeColor.setAttribute('content', '#111827');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.style.backgroundColor = '#f3f4f6';
                    if (metaThemeColor) metaThemeColor.setAttribute('content', '#f3f4f6');
                }
            } catch (e) {}
        </script>
        <style>
            html.dark body { background-color: #111827 !important; }
            html:not(.dark) body { background-color: #f3f4f6 !important; }
        </style>

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

        <!-- CSS dan dark mode dihandle oleh app.css dan app.js -->
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-indigo-400/20 to-purple-400/20 rounded-full blur-3xl transform translate-x-1/3 -translate-y-1/3"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full blur-3xl transform -translate-x-1/3 translate-y-1/3"></div>
            </div>

            <div class="relative z-10 w-full max-w-[310px] mx-3 px-2.5 py-2.5 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700">
                <?php echo e($slot); ?>

            </div>


        </div>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    </body>
</html>
<?php /**PATH C:\laragon\www\thrif\resources\views/layouts/guest.blade.php ENDPATH**/ ?>