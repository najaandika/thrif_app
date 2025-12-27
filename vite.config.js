import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/landing.css',
                'resources/js/landing-checkout.js',
                'resources/js/swal.js',
                'resources/js/cart-checkout.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Listen on all addresses
        hmr: {
            host: 'localhost', // Recommendation: If testing on network, change this to your PC's IP. But for now I'll leave it or comment it out? 
            // Better: Remove it so it auto-detects, OR set it to the IP if we knew it.
            // If I remove it, it defaults to checking window.location, which might be correct if they access via IP.
            // But if they access via localhost and it serves 0.0.0.0, it works.
        },
    },
});
