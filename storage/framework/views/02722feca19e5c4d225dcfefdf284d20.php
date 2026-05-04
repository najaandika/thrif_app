<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo e($title ?? 'Checkout - ' . config('app.name')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <meta name="theme-color" content="#f3f4f6">
        <!-- Dark Mode Script (Prevent FOUC) -->
        <script>
            (function() {
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
                        document.documentElement.style.backgroundColor = '#f9fafb';
                        if (metaThemeColor) metaThemeColor.setAttribute('content', '#f9fafb');
                    }
                } catch (e) {}
            })();
        </script>
        <style>
            [x-cloak] { display: none !important; }
            /* Critical CSS to prevent FOUC */
            html.dark body { background-color: #111827 !important; }
            html:not(.dark) body { background-color: #f9fafb !important; }
        </style>

        <!-- Styles -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

        
        <!-- Midtrans -->
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(config('services.midtrans.client_key')); ?>"></script>
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        
        <!-- Simplified Header -->
        <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-end">
                <!-- Secure Badge / Back Link -->
                <div class="flex items-center gap-4 text-sm">
                    <div class="hidden sm:flex items-center gap-1.5 text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span class="font-medium">Secure Checkout</span>
                    </div>
                    <a href="<?php echo e(route('landing.home')); ?>" class="text-gray-500 hover:text-gray-900 dark:hover:text-gray-100 transition">
                        Cancel
                    </a>
                </div>
            </div>
        </header>

        <main class="py-12">
            <?php echo e($slot); ?>

        </main>



        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

        <?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html>
<?php /**PATH C:\laragon\www\thrif\resources\views\layouts\checkout.blade.php ENDPATH**/ ?>