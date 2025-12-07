<?php

namespace App\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class LandingComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with([
            // Shop Information
            'shopLogo' => Setting::get('shop_logo'),
            'shopName' => Setting::get('shop_name', 'Thrif'),
            'shopTagline' => Setting::get('shop_tagline', 'Your trusted thrift store'),
            'shopEmail' => Setting::get('shop_email', 'contact@thrif.com'),
            'shopPhone' => Setting::get('shop_phone'),
            'shopAddress' => Setting::get('shop_address'),
            
            // About Section
            'aboutTitle' => Setting::get('about_title', 'Tentang Kami'),
            'aboutDescription' => Setting::get('about_description', 'Tempat terbaik untuk menemukan koleksi pre-loved berkualitas dengan harga terjangkau.'),
            'aboutFeature1' => Setting::get('about_feature_1', 'Pre-loved Quality'),
            'aboutFeature2' => Setting::get('about_feature_2', 'Stok Real-time'),
            'aboutFeature3' => Setting::get('about_feature_3', 'Terpercaya'),
            
            // Social Media
            'socialInstagram' => Setting::get('social_instagram'),
            'socialFacebook' => Setting::get('social_facebook'),
            'socialTiktok' => Setting::get('social_tiktok'),
            
            // Operating Info
            'operatingHours' => Setting::get('operating_hours', 'Setiap Hari, 09:00 - 21:00'),
            'paymentMethods' => Setting::get('payment_methods', 'Transfer Bank & E-Wallet'),
        ]);
    }
}
