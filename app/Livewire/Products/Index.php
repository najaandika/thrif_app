<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $availability = 'all';
    public $promo = 'all';
    public $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'availability' => ['except' => 'all'],
        'promo' => ['except' => 'all'],
        'sort' => ['except' => 'latest'],
    ];

    protected $listeners = [
        'delete' => 'deleteProduct',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingAvailability()
    {
        $this->resetPage();
    }

    public function updatingPromo()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    public function deleteProduct(int $id): void
    {
        $product = Product::find($id);

        if ($product && (Auth::user()->isAdmin() || $product->user_id === Auth::id())) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();
            \Illuminate\Support\Facades\Cache::forget('landing_page_data');
            session()->flash('message', 'Product deleted successfully.');
        }
    }

    public function render()
    {
        $baseQuery = Product::query();

        if (! Auth::user()->isAdmin()) {
            $baseQuery->where('user_id', Auth::id());
        }

        $productStats = [
            'total' => (clone $baseQuery)->count(),
            'ready' => (clone $baseQuery)->where('is_available', true)->count(),
            'sold' => (clone $baseQuery)->where('is_available', false)->count(),
            'promo' => (clone $baseQuery)
                ->where('discount_percentage', '>', 0)
                ->where(function ($query) {
                    $query->whereNull('discount_start')
                        ->orWhere('discount_start', '<=', now());
                })
                ->where(function ($query) {
                    $query->whereNull('discount_end')
                        ->orWhere('discount_end', '>=', now());
                })
                ->count(),
        ];

        $products = (clone $baseQuery)->with(['user'])
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('category', 'like', '%' . $this->search . '%')
                        ->orWhere('size', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function ($query) {
                $query->where('category', $this->category);
            })
            ->when($this->availability === 'ready', fn ($query) => $query->where('is_available', true))
            ->when($this->availability === 'sold', fn ($query) => $query->where('is_available', false))
            ->when($this->promo === 'sale', function ($query) {
                $query->where('discount_percentage', '>', 0)
                    ->where(function ($query) {
                        $query->whereNull('discount_start')
                            ->orWhere('discount_start', '<=', now());
                    })
                    ->where(function ($query) {
                        $query->whereNull('discount_end')
                            ->orWhere('discount_end', '>=', now());
                    });
            })
            ->when($this->promo === 'regular', function ($query) {
                $query->where(function ($query) {
                    $query->whereNull('discount_percentage')
                        ->orWhere('discount_percentage', '<=', 0)
                        ->orWhere('discount_start', '>', now())
                        ->orWhere('discount_end', '<', now());
                });
            })
            ->when($this->sort === 'price_low', fn ($query) => $query->orderByRaw('(price * (1 - COALESCE(discount_percentage, 0) / 100)) asc'))
            ->when($this->sort === 'price_high', fn ($query) => $query->orderByRaw('(price * (1 - COALESCE(discount_percentage, 0) / 100)) desc'))
            ->when($this->sort === 'discount', fn ($query) => $query->orderByDesc('discount_percentage')->latest())
            ->when($this->sort === 'latest' || ! in_array($this->sort, ['price_low', 'price_high', 'discount'], true), fn ($query) => $query->latest())
            ->paginate(10);

        $categories = Category::orderBy('name')->get();

        return view('livewire.products.index', [
            'products' => $products,
            'categories' => $categories,
            'productStats' => $productStats,
        ]);
    }
}
