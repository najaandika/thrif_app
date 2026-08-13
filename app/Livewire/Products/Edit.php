<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

    // Discount fields
    public $discount_percentage;
    public $discount_start;
    public $discount_end;

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
        'discount_percentage' => 'nullable|numeric|min:0|max:100',
        'discount_start' => 'nullable|date',
        'discount_end' => 'nullable|date|after_or_equal:discount_start',
        'condition' => 'required|in:new,like-new,good,fair,poor',
        'category' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:10240',
        'is_available' => 'boolean',
        'size' => 'required|string|max:100',
        'additionalImages.*' => 'nullable|image|max:10240',
        'newAdditionalImages.*' => 'nullable|image|max:10240',
    ];

    public function mount(Product $product)
    {
        if (!Auth::user()->isAdmin() && $product->user_id !== Auth::id()) {
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
        
        // Load discount fields
        $this->discount_percentage = $product->discount_percentage;
        $this->discount_start = $product->discount_start?->format('Y-m-d\TH:i');
        $this->discount_end = $product->discount_end?->format('Y-m-d\TH:i');
    }



    public function updatedDiscountPercentage($value)
    {
        if ($value === '' || $value === null) {
            $this->discount_percentage = null;
            return;
        }

        $this->discount_percentage = min(100, max(0, (int) preg_replace('/\D/', '', (string) $value)));
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
                $this->additionalImagePreviews[$key] = Storage::disk('public')->url('livewire-tmp/' . $image->getFilename());
            } catch (\Exception $exception) {
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
            'discount_percentage' => $this->discount_percentage ?: null,
            'discount_start' => $this->discount_start ?: null,
            'discount_end' => $this->discount_end ?: null,
            'condition' => $this->condition,
            'category' => $this->category,
            'is_available' => $this->is_available ?? true,
            'size' => $this->size,
        ];

        if ($this->image) {
            if ($this->product->image) {
                Storage::disk('public')->delete($this->product->image);
            }
            
            $manager = new ImageManager(new Driver());
            $imageName = 'products/' . uniqid() . '.webp';
            
            $img = $manager->read($this->image->getRealPath());
            $img->scaleDown(width: 480);
            
            $encoded = $img->toWebp(80);
            Storage::disk('public')->put($imageName, (string) $encoded);
            
            $data['image'] = $imageName;
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
            
            $manager = new ImageManager(new Driver());
            
            foreach ($this->additionalImages as $index => $additionalImage) {
                $additionalImageName = 'products/' . uniqid() . '.webp';
                $img = $manager->read($additionalImage->getRealPath());
                $img->scaleDown(width: 480);
                
                $encoded = $img->toWebp(80);
                Storage::disk('public')->put($additionalImageName, (string) $encoded);
                
                $this->product->images()->create([
                    'image_path' => $additionalImageName,
                    'sort_order' => $currentMaxSort + $index + 1,
                ]);
            }
        }

        $this->product->update($data);

        \Illuminate\Support\Facades\Cache::forget('landing_page_data');

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
