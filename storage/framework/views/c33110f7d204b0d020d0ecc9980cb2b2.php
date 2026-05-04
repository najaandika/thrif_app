<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="google-site-verification" content="O2SB5f86omCMI4ga40t9GFKcbyIrksri6XEHdxy5adk" />
        <title><?php echo e($title ?? 'Mr Crab Shop - Thrift Store Terpercaya'); ?></title>
        <meta name="description" content="<?php echo e($metaDescription ?? 'Mr Crab Shop - Toko thrift online terpercaya. Koleksi pakaian secondhand berkualitas, dikurasi manual, difoto apa adanya. Pengiriman cepat ke seluruh Indonesia.'); ?>">
        <link rel="canonical" href="<?php echo e(url()->current()); ?>">

        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php echo e($title ?? 'Mr Crab Shop - Thrift Store Terpercaya'); ?>">
        <meta property="og:description" content="<?php echo e($metaDescription ?? 'Toko thrift online terpercaya. Koleksi pakaian secondhand berkualitas, dikurasi manual, difoto apa adanya.'); ?>">
        <meta property="og:url" content="<?php echo e(url()->current()); ?>">
        <meta property="og:site_name" content="Mr Crab Shop">
        <?php if(isset($ogImage)): ?>
        <meta property="og:image" content="<?php echo e($ogImage); ?>">
        <?php endif; ?>

        <!-- Fonts: self-hosted via app.css @font-face -->

        <!-- AI Search Engine Optimization (JSON-LD Schema Markup) -->
        <script type="application/ld+json">
        {
          "<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>": "https://schema.org",
          "@graph": [
            {
              "@type": "WebSite",
              "name": "Mr Crab Shop",
              "url": "<?php echo e(url('/')); ?>",
              "description": "Toko thrift online terpercaya. Koleksi pakaian secondhand berkualitas, dikurasi manual, difoto apa adanya."
            },
            {
              "@type": "Store",
              "name": "Mr Crab Shop",
              "image": "<?php echo e(isset($ogImage) ? $ogImage : url('/images/logo.png')); ?>",
              "description": "Thrift store online menyediakan pakaian preloved berkualitas.",
              "url": "<?php echo e(url('/')); ?>",
              "priceRange": "$$"
            }
          ]
        }
        </script>

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

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Styles -->
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ajax-cart.js']); ?>
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-900" x-data>
        <div class="min-h-screen flex flex-col">
            <?php echo $__env->make('landing.sections.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <main class="flex-1">
                <?php echo e($slot); ?>

            </main>

            <?php echo $__env->make('landing.sections.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <?php echo $__env->make('landing.sections.login-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php if (isset($component)) { $__componentOriginal7cfab914afdd05940201ca0b2cbc009b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $attributes = $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $component = $__componentOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    </body>
</html>
<?php /**PATH C:\laragon\www\thrif\resources\views\layouts\landing.blade.php ENDPATH**/ ?>