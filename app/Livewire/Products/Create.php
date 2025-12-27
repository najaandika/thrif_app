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
    
    public $newAdditionalImages = []; // For input
    public $additionalImages = []; // Accumulator
    public $additionalImagePreviews = [];
    public $uploadIteration = 0;
    
    public $size;

    // Discount fields
    public $discount_percentage;
    public $discount_start;
    public $discount_end;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'discount_percentage' => 'nullable|numeric|min:0|max:100',
        'discount_start' => 'nullable|date',
        'discount_end' => 'nullable|date|after_or_equal:discount_start',
        'condition' => 'required|in:new,like-new,good,fair,poor',
        'category' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
        'additionalImages.*' => 'nullable|image|max:2048',
        'newAdditionalImages.*' => 'nullable|image|max:2048',
        'size' => 'required|string|max:100',
    ];



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

    public function updatedNewAdditionalImages()
    {
        $this->resetErrorBag('newAdditionalImages');
        
        foreach ($this->newAdditionalImages as $image) {
            $this->additionalImages[] = $image;
        }

        $this->updatePreviews();
        
        // Reset input
        $this->newAdditionalImages = [];
        $this->uploadIteration++;
    }

    protected function updatePreviews()
    {
        $this->additionalImagePreviews = [];
        foreach ($this->additionalImages as $key => $image) {
            try {
                $this->additionalImagePreviews[$key] = $image->temporaryUrl();
            } catch (\Livewire\Features\SupportFileUploads\FileNotPreviewableException $exception) {
                // Skip preview
            }
        }
    }

    public function removeAdditionalImage($index)
    {
        unset($this->additionalImages[$index]);
        unset($this->additionalImagePreviews[$index]);
        $this->additionalImages = array_values($this->additionalImages);
        $this->additionalImagePreviews = array_values($this->additionalImagePreviews);
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        $product = Product::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'discount_percentage' => $this->discount_percentage ?: null,
            'discount_start' => $this->discount_start ?: null,
            'discount_end' => $this->discount_end ?: null,
            'condition' => $this->condition,
            'category' => $this->category,
            'image' => $imagePath,
            'size' => $this->size,
        ]);

        // Save additional images
        if (!empty($this->additionalImages)) {
            foreach ($this->additionalImages as $index => $additionalImage) {
                $additionalImagePath = $additionalImage->store('products', 'public');
                $product->images()->create([
                    'image_path' => $additionalImagePath,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        session()->flash('message', 'Product created successfully.');
        return redirect()->route('products.index');
    }

    public function render()
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('livewire.products.create', [
            'categories' => $categories,
        ]);
    }
}
