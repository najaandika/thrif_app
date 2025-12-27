<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Blade::include('components.test', 'test');
        
        // Force HTTPS for Ngrok (Optional: Keep it if you use Ngrok often, or remove it entirely)
        if (str_contains(config('app.url'), 'ngrok')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Register View Composer for Landing Pages
        \Illuminate\Support\Facades\View::composer([
            'landing.sections.header',
            'landing.sections.footer',
            'landing.sections.about',
            'landing.sections.contact',
        ], \App\View\Composers\LandingComposer::class);
    }
}
