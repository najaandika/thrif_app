<?php

namespace App\Livewire\LandingProducts;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.clean')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $promo = false;

    public $categories = [];

    protected $queryString = ['search', 'category', 'promo'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingPromo()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->promo = false;
        $this->category = '';
        $this->resetPage();
    }

    public function togglePromo()
    {
        $this->promo = !$this->promo;
        $this->resetPage();
    }

    public function mount(): void
    {
        $this->categories = Category::query()
            ->orderBy('name')
            ->pluck('name', 'name')
            ->toArray();
        
        // Initialize promo from query string
        $this->promo = request()->boolean('promo');
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('category', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function ($query) {
                $query->where('category', $this->category);
            })
            ->when($this->promo, function ($query) {
                // Filter products with active discount
                $query->where('discount_percentage', '>', 0)
                    ->where(function ($q) {
                        $q->whereNull('discount_start')
                            ->orWhere('discount_start', '<=', now());
                    })
                    ->where(function ($q) {
                        $q->whereNull('discount_end')
                            ->orWhere('discount_end', '>=', now());
                    });
            })
            ->where('is_available', true)
            ->latest()
            ->paginate(12);

        return view('livewire.landing-products.index', [
            'products' => $products,
        ]);
    }
}
