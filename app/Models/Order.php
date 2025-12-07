<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'product_id',
        'buyer_name',
        'buyer_contact',
        'shipping_address',
        'quantity',
        'size',
        'total_price',
        'status',
        'payment_method',
        'payment_status',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'total_price' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the CSS classes for status badge based on order status.
     * Only 'pending' and 'paid' statuses are currently used in the system.
     */
    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-200',
            'paid' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-900/40 dark:text-gray-200',
        };
    }
}
