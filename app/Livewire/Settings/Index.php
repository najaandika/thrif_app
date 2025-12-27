<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithFileUploads;

    public $shop_name;
    public $shop_tagline;
    public $shop_email;
    public $shop_phone;
    public $shop_address;
    public $shop_location_name;
    public $shop_maps_url;
    public $shop_logo;
    public $new_logo;
    
    // Social Media
    public $social_instagram;
    public $social_facebook;
    public $social_tiktok;
    
    // Business Info
    public $operating_hours;
    public $payment_methods;
    
    // About Section
    public $about_title;
    public $about_description;
    public $about_feature_1;
    public $about_feature_2;
    public $about_feature_3;
    
    // Active tab
    public $activeTab = 'shop';

    public function mount()
    {
        $this->shop_name = Setting::get('shop_name', 'Thrif');
        $this->shop_tagline = Setting::get('shop_tagline');
        $this->shop_email = Setting::get('shop_email');
        $this->shop_phone = Setting::get('shop_phone');
        $this->shop_address = Setting::get('shop_address');
        $this->shop_location_name = Setting::get('shop_location_name');
        $this->shop_maps_url = Setting::get('shop_maps_url');
        $this->shop_logo = Setting::get('shop_logo');
        
        $this->social_instagram = Setting::get('social_instagram');
        $this->social_facebook = Setting::get('social_facebook');
        $this->social_tiktok = Setting::get('social_tiktok');
        
        $this->operating_hours = Setting::get('operating_hours', 'Setiap Hari, 09:00 - 21:00');
        $this->payment_methods = Setting::get('payment_methods', 'Transfer Bank & E-Wallet');
        
        $this->about_title = Setting::get('about_title', 'Tentang Kami');
        $this->about_description = Setting::get('about_description');
        $this->about_feature_1 = Setting::get('about_feature_1');
        $this->about_feature_2 = Setting::get('about_feature_2');
        $this->about_feature_3 = Setting::get('about_feature_3');
    }

    public function save()
    {
        $this->validate([
            'shop_name' => 'required|string|max:255',
            'shop_tagline' => 'nullable|string|max:500',
            'shop_email' => 'nullable|email|max:255',
            'shop_phone' => 'nullable|string|max:50',
            'shop_address' => 'nullable|string|max:1000',
            'shop_location_name' => 'nullable|string|max:255',
            'shop_maps_url' => 'nullable|url|max:500',
            'new_logo' => 'nullable|image|max:2048',
            'social_instagram' => 'nullable|url|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_tiktok' => 'nullable|url|max:255',
            'operating_hours' => 'nullable|string|max:255',
            'payment_methods' => 'nullable|string|max:500',
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string|max:1000',
            'about_feature_1' => 'nullable|string|max:100',
            'about_feature_2' => 'nullable|string|max:100',
            'about_feature_3' => 'nullable|string|max:100',
        ]);

        Setting::set('shop_name', $this->shop_name);
        Setting::set('shop_tagline', $this->shop_tagline);
        Setting::set('shop_email', $this->shop_email);
        Setting::set('shop_phone', $this->shop_phone);
        Setting::set('shop_address', $this->shop_address);
        Setting::set('shop_location_name', $this->shop_location_name);
        Setting::set('shop_maps_url', $this->shop_maps_url);
        
        Setting::set('social_instagram', $this->social_instagram);
        Setting::set('social_facebook', $this->social_facebook);
        Setting::set('social_tiktok', $this->social_tiktok);
        
        Setting::set('operating_hours', $this->operating_hours);
        Setting::set('payment_methods', $this->payment_methods);
        
        Setting::set('about_title', $this->about_title);
        Setting::set('about_description', $this->about_description);
        Setting::set('about_feature_1', $this->about_feature_1);
        Setting::set('about_feature_2', $this->about_feature_2);
        Setting::set('about_feature_3', $this->about_feature_3);

        if ($this->new_logo) {
            // Delete old logo if exists
            if ($this->shop_logo) {
                Storage::disk('public')->delete($this->shop_logo);
            }

            // Store new logo
            $path = $this->new_logo->store('logos', 'public');
            Setting::set('shop_logo', $path);
            $this->shop_logo = $path;
            $this->new_logo = null;
        }

        session()->flash('message', 'Settings saved successfully!');
    }

    public function removeLogo()
    {
        if ($this->shop_logo) {
            Storage::disk('public')->delete($this->shop_logo);
            Setting::set('shop_logo', null);
            $this->shop_logo = null;
            session()->flash('message', 'Logo removed successfully!');
        }
    }

    public function render()
    {
        return view('livewire.settings.index');
    }
}
