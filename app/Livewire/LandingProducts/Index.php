<?php

namespace App\Livewire\LandingProducts;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.clean')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $promo = false;
    public $sort = 'latest';

    public $categories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'promo' => ['except' => false],
        'sort' => ['except' => 'latest'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function updatingPromo(): void
    {
        $this->resetPage();
    }

    public function updatingSort(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->promo = false;
        $this->category = '';
        $this->search = '';
        $this->sort = 'latest';
        $this->resetPage();
    }

    public function togglePromo(): void
    {
        $this->promo = ! $this->promo;
        $this->resetPage();
    }

    public function mount(): void
    {
        $this->categories = Category::query()
            ->orderBy('name')
            ->pluck('name', 'name')
            ->toArray();

        $requestedSort = request('sort', 'latest');

        $this->promo = request()->boolean('promo');
        $this->sort = in_array($requestedSort, ['latest', 'price_low', 'price_high', 'discount'], true)
            ? $requestedSort
            : 'latest';
    }

    public function render()
    {
        $products = Product::query()
            ->select([
                'id',
                'name',
                'description',
                'price',
                'discount_percentage',
                'discount_start',
                'discount_end',
                'condition',
                'category',
                'image',
                'size',
                'is_available',
                'created_at',
            ])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('category', 'like', '%' . $this->search . '%')
                        ->orWhere('size', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function ($query) {
                $query->where('category', $this->category);
            })
            ->when($this->promo, function ($query) {
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
            ->when($this->sort === 'price_low', fn ($query) => $query->orderByRaw('(price * (1 - COALESCE(discount_percentage, 0) / 100)) asc'))
            ->when($this->sort === 'price_high', fn ($query) => $query->orderByRaw('(price * (1 - COALESCE(discount_percentage, 0) / 100)) desc'))
            ->when($this->sort === 'discount', fn ($query) => $query->orderByDesc('discount_percentage')->latest())
            ->when($this->sort === 'latest' || ! in_array($this->sort, ['price_low', 'price_high', 'discount'], true), fn ($query) => $query->latest())
            ->paginate(12);

        return view('livewire.landing-products.index', [
            'products' => $products,
        ]);
    }
}
