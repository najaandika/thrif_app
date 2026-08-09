<?php

namespace App\Livewire\Promotions;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        $products = Product::query()
            ->where('discount_percentage', '>', 0)
            ->latest()
            ->take(12)
            ->get();

        return view('livewire.promotions.index', [
            'products' => $products,
            'activePromos' => $products->where('is_on_sale', true)->count(),
        ]);
    }
}
