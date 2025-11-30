<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public const CONDITION_LABELS = [
        'new' => 'Baru (with tag)',
        'like-new' => 'Seperti baru',
        'good' => 'Bagus (dipakai ringan)',
        'fair' => 'Cukup (ada wear kecil)',
        'poor' => 'Banyak wear',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'condition',
        'category',
        'size',
        'stock',
        'image',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
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

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    public function getTotalStockAttribute(): int
    {
        return $this->sizes()->sum('stock');
    }

    public function getConditionLabelAttribute(): string
    {
        return self::CONDITION_LABELS[$this->condition] ?? ucfirst(str_replace('-', ' ', (string) $this->condition));
    }
}
