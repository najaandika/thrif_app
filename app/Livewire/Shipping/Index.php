<?php

namespace App\Livewire\Shipping;

use App\Models\ShippingSetting;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public $base_distance_km = 3;
    public $base_price = 0;
    public $price_per_km = 0;

    protected $rules = [
        'base_distance_km' => 'required|numeric|min:0',
        'base_price' => 'required|numeric|min:0',
        'price_per_km' => 'required|numeric|min:0',
    ];

    public function mount(): void
    {
        $setting = ShippingSetting::current();

        $this->base_distance_km = $setting->base_distance_km;
        $this->base_price = $setting->base_price;
        $this->price_per_km = $setting->price_per_km;
    }

    public function save(): void
    {
        $data = $this->validate();

        ShippingSetting::current()->update($data);

        session()->flash('message', 'Pengaturan pengiriman berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.shipping.index');
    }
}
