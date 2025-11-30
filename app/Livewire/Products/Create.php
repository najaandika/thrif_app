<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\FileNotPreviewableException;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $price;
    public $condition = 'good';
    public $category;
    public $image;
    public $imagePreviewUrl = null;
    
    public $variants = [
        ['size' => '', 'stock' => 0]
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|in:new,like-new,good,fair,poor',
        'category' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
        'variants' => 'required|array|min:1',
        'variants.*.size' => 'required|string|max:100|distinct',
        'variants.*.stock' => 'required|integer|min:0',
    ];

    public function addVariant()
    {
        $this->variants[] = ['size' => '', 'stock' => 0];
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function updatedImage($value)
    {
        $this->resetErrorBag('image');
        $this->imagePreviewUrl = null;

        if (! $value) {
            return;
        }

        try {
            $this->imagePreviewUrl = $this->image->temporaryUrl();
        } catch (FileNotPreviewableException $exception) {
            $this->addError('image', 'File tidak bisa dipratinjau. Gunakan gambar dengan format JPG, PNG, atau WebP.');
        }
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        $totalStock = collect($this->variants)->sum('stock');

        $product = Product::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $totalStock,
            'condition' => $this->condition,
            'category' => $this->category,
            'image' => $imagePath,
        ]);

        foreach ($this->variants as $variant) {
            $product->sizes()->create($variant);
        }

        session()->flash('message', 'Product created successfully.');
        return redirect()->route('products.index');
    }

    public function render()
    {
        $categories = Category::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('livewire.products.create', [
            'categories' => $categories,
        ]);
    }
}
