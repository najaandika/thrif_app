<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Edit extends Component
{
    use WithFileUploads;

    public Product $product;
    public $name;
    public $description;
    public $price;
    public $condition;
    public $category;
    public $stock;
    public $image;
    public $is_available;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'condition' => 'required|in:new,like-new,good,fair,poor',
        'category' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
        'is_available' => 'boolean',
    ];

    public function mount(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->condition = $product->condition;
        $this->category = $product->category;
        $this->stock = $product->stock;
        $this->is_available = $product->is_available;
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'condition' => $this->condition,
            'category' => $this->category,
            'is_available' => $this->is_available ?? true,
        ];

        if ($this->image) {
            if ($this->product->image) {
                Storage::disk('public')->delete($this->product->image);
            }
            $data['image'] = $this->image->store('products', 'public');
        }

        $this->product->update($data);

        session()->flash('message', 'Product updated successfully.');
        return redirect()->route('products.index');
    }

    public function render()
    {
        $categories = Category::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('livewire.products.edit', [
            'categories' => $categories,
        ]);
    }
}
