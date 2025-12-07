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
}
