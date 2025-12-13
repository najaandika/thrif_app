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

    public $size;

    // Additional Images
    public $newAdditionalImages = []; // For input
    public $additionalImages = []; // Accumulator
    public $additionalImagePreviews = [];
    public $uploadIteration = 0;
    public $imagesToDelete = []; // IDs of existing images to delete

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|in:new,like-new,good,fair,poor',
        'category' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
        'is_available' => 'boolean',
        'size' => 'required|string|max:100',
        'additionalImages.*' => 'nullable|image|max:2048',
        'newAdditionalImages.*' => 'nullable|image|max:2048',
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

        $this->size = $product->size;
        // Stock dihapus, tidak perlu di-set
    }



    public function updatedNewAdditionalImages()
    {
        $this->resetErrorBag('newAdditionalImages');
        
        foreach ($this->newAdditionalImages as $image) {
            $this->additionalImages[] = $image;
        }

        $this->updatePreviews();
        
        // Reset input to allow adding more
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

    public function removeNewAdditionalImage($index)
    {
        unset($this->additionalImages[$index]);
        unset($this->additionalImagePreviews[$index]);
        $this->additionalImages = array_values($this->additionalImages);
        $this->additionalImagePreviews = array_values($this->additionalImagePreviews);
    }

    public function deleteExistingImage($imageId)
    {
        // Don't delete immediately, just mark for deletion
        if (!in_array($imageId, $this->imagesToDelete)) {
            $this->imagesToDelete[] = $imageId;
        }
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'condition' => $this->condition,
            'category' => $this->category,
            'is_available' => $this->is_available ?? true,
            'size' => $this->size,
        ];

        if ($this->image) {
            if ($this->product->image) {
                Storage::disk('public')->delete($this->product->image);
            }
            $data['image'] = $this->image->store('products', 'public');
        }

        // Process deferred deletions
        if (!empty($this->imagesToDelete)) {
            $imagesToDelete = \App\Models\ProductImage::whereIn('id', $this->imagesToDelete)
                ->where('product_id', $this->product->id)
                ->get();

            foreach ($imagesToDelete as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
        }

        // Save new additional images
        if (!empty($this->additionalImages)) {
            // Get current max sort order
            $currentMaxSort = $this->product->images()->max('sort_order') ?? 0;
            
            foreach ($this->additionalImages as $index => $additionalImage) {
                $additionalImagePath = $additionalImage->store('products', 'public');
                $this->product->images()->create([
                    'image_path' => $additionalImagePath,
                    'sort_order' => $currentMaxSort + $index + 1,
                ]);
            }
        }

        $this->product->update($data);

        session()->flash('message', 'Product updated successfully.');
        return redirect()->route('products.index');
    }

    public function render()
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('livewire.products.edit', [
            'categories' => $categories,
        ]);
    }
}
