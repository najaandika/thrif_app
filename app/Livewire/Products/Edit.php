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
    public $image;
    public $is_available;

    public $variants = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|in:new,like-new,good,fair,poor',
        'category' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
        'is_available' => 'boolean',
        'variants' => 'required|array|min:1',
        'variants.*.size' => 'required|string|max:100|distinct',
        'variants.*.stock' => 'required|integer|min:0',
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
        $this->is_available = $product->is_available;

        $this->variants = $product->sizes->map(fn($s) => [
            'id' => $s->id,
            'size' => $s->size,
            'stock' => $s->stock
        ])->toArray();

        if (empty($this->variants)) {
            $this->variants[] = ['size' => '', 'stock' => 0];
        }
    }

    public function addVariant()
    {
        $this->variants[] = ['size' => '', 'stock' => 0];
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function update()
    {
        $this->validate();

        $totalStock = collect($this->variants)->sum('stock');

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $totalStock,
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

        // Sync variants
        $keepIds = [];
        foreach ($this->variants as $variant) {
            if (isset($variant['id'])) {
                $this->product->sizes()->where('id', $variant['id'])->update([
                    'size' => $variant['size'],
                    'stock' => $variant['stock'],
                ]);
                $keepIds[] = $variant['id'];
            } else {
                $newVariant = $this->product->sizes()->create([
                    'size' => $variant['size'],
                    'stock' => $variant['stock'],
                ]);
                $keepIds[] = $newVariant->id;
            }
        }

        $this->product->sizes()->whereNotIn('id', $keepIds)->delete();

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
