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
        
        return route('landing.products.show', $this);
    }

    public function getConditionLabelAttribute(): string
    {
        return self::CONDITION_LABELS[$this->condition] ?? ucfirst(str_replace('-', ' ', (string) $this->condition));
    }

    public function getConditionClassAttribute(): string
    {
        return match ($this->condition) {
            'new' => 'bg-indigo-500',
            'like-new', 'like_new' => 'bg-blue-500',
            'good' => 'bg-emerald-500',
            'fair' => 'bg-yellow-500',
            'poor', 'defect' => 'bg-red-500',
            default => 'bg-gray-500'
        };
    }

    public function getConditionColorAttribute(): string
    {
        return match ($this->condition) {
            'new' => '#4338ca', // indigo-700
            'like-new', 'like_new' => '#1d4ed8', // blue-700
            'good' => '#047857', // emerald-700
            'fair' => '#a16207', // yellow-700
            'poor', 'defect' => '#b91c1c', // red-700
            default => '#4b5563' // gray-600
        };
    }
}
