<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'type', // 'online', 'pos'
        'user_id', // Cashier/User
        'customer_id', // Customer (optional)
        'invoice_number',
        'buyer_name',
        'buyer_contact',
        'shipping_address',
        'total_price',
        'amount_received', // For POS
        'discount', // Discount amount
        'status',
        'payment_method',
        'payment_status',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'amount_received' => 'decimal:2',
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

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    
    // Helper to get the first product name (for display in lists where we can't show all)
    public function getProductNameAttribute()
    {
        return $this->items->first()?->product->name ?? 'Deleted Product';
    }

    // SCOPES
    public function scopeOnline($query)
    {
        return $query->where('type', 'online');
    }

    public function scopePos($query)
    {
        return $query->where('type', 'pos');
    }

    // ACCESSORS
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'paid' => 'Lunas',
            default => ucfirst($this->status),
        };
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-100 text-amber-800 border-amber-200 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20',
            'paid' => 'bg-emerald-500 text-white border-transparent shadow-sm dark:bg-emerald-600 dark:text-white',
            default => 'bg-slate-100 text-slate-700 border-slate-200 dark:bg-slate-700/50 dark:text-slate-300 dark:border-slate-600',
        };
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            if (!$order->invoice_number) {
                $order->invoice_number = self::generateInvoiceNumber();
            }
        });
    }

    public static function generateInvoiceNumber()
    {
        $prefix = 'INV/' . date('Ymd') . '/';
        $latestOrder = self::where('invoice_number', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($latestOrder) {
            $lastNumber = intval(substr($latestOrder->invoice_number, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
