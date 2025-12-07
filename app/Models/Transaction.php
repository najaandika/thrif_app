<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'discount',
        'payment_method',
        'payment_status',
        'paid_at',
        'amount_received',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'amount_received' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function getChangeAttribute()
    {
        return max($this->amount_received - $this->total_price, 0);
    }
}
