<?php

namespace App\Livewire\Products;

use App\Models\Product;
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

    protected $queryString = ['search'];

    protected $listeners = [
        'delete' => 'deleteProduct',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteProduct(int $id): void
    {
        $product = Product::find($id);

        if ($product && $product->user_id === Auth::id()) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();
            session()->flash('message', 'Product deleted successfully.');
        }
    }

    public function render()
    {
        $products = Product::with(['user', 'sizes'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('category', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.products.index', [
            'products' => $products,
        ]);
    }
}
