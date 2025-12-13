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

    public $categories = [];

    protected $queryString = ['search', 'category'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function mount(): void
    {
        $this->categories = Category::query()
            ->orderBy('name')
            ->pluck('name', 'name')
            ->toArray();
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
            ->where('is_available', true)
            ->latest()
            ->paginate(12);

        return view('livewire.landing-products.index', [
            'products' => $products,
        ]);
    }
}
