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
        'condition',
        'category',
        'size',
        'image',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',

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
            'new' => 'bg-indigo-500',
            'like-new', 'like_new' => 'bg-blue-500',
            'good' => 'bg-emerald-500',
            'fair' => 'bg-yellow-500',
            'poor', 'defect' => 'bg-red-500',
            default => 'bg-gray-500'
        };
    }
}
