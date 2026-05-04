<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public const CONDITION_LABELS = [
        'new' => 'New',
        'like-new' => 'Like New',
        'good' => 'Good',
        'fair' => 'Fair',
        'poor' => 'Poor',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'discount_percentage',
        'discount_start',
        'discount_end',
        'condition',
        'category',
        'size',
        'image',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'discount_start' => 'datetime',
        'discount_end' => 'datetime',
        'is_available' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function getGalleryAttribute()
    {
        $gallery = collect();
        
        if ($this->image) {
            $gallery->push((object)[
                'image_path' => $this->image,
                'is_main' => true
            ]);
        }
        
        foreach ($this->images as $img) {
            $gallery->push((object)[
                'image_path' => $img->image_path,
                'is_main' => false
            ]);
        }
        
        return $gallery;
    }

    /**
     * Check if product is currently on sale (discount active).
     */
    public function getIsOnSaleAttribute(): bool
    {
        if (!$this->discount_percentage || $this->discount_percentage <= 0) {
            return false;
        }

        $now = now();

        // If start date is set and we're before it, not on sale
        if ($this->discount_start && $now->lt($this->discount_start)) {
            return false;
        }

        // If end date is set and we're past it, not on sale
        if ($this->discount_end && $now->gt($this->discount_end)) {
            return false;
        }

        return true;
    }

    /**
     * Get the final price after discount (if applicable).
     */
    public function getFinalPriceAttribute(): float
    {
        if (!$this->is_on_sale) {
            return (float) $this->price;
        }

        return (float) ($this->price * (1 - $this->discount_percentage / 100));
    }

    /**
     * Get the discount percent (for display, rounded).
     */
    public function getDiscountPercentAttribute(): int
    {
        if (!$this->is_on_sale) {
            return 0;
        }

        return (int) round($this->discount_percentage);
    }

    /**
     * Get the appropriate action link for this product based on user role.
     * Admin users get edit link, customers get checkout link.
     */
    public function getActionLink(): string
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return route('products.edit', $this);
        }
        
        return route('landing.products.checkout', $this);
    }

    public function getConditionLabelAttribute(): string
    {
        return self::CONDITION_LABELS[$this->condition] ?? ucfirst(str_replace('-', ' ', (string) $this->condition));
    }

    public function getConditionClassAttribute(): string
    {
        return match ($this->condition) {
            'new' => 'bg-indigo-700',
            'like-new', 'like_new' => 'bg-blue-700',
            'good' => 'bg-emerald-700',
            'fair' => 'bg-yellow-700',
            'poor', 'defect' => 'bg-red-700',
            default => 'bg-gray-600'
        };
    }
}
