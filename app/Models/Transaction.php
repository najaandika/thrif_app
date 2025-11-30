<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'total_qty',
        'total_price',
        'discount',
        'payment_method',
        'payment_status',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'total_qty' => 'integer',
        'total_price' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
}
