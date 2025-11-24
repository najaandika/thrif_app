<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingSetting extends Model
{
    protected $fillable = [
        'base_distance_km',
        'base_price',
        'price_per_km',
    ];

    public static function current(): self
    {
        return static::firstOrCreate([], [
            'base_distance_km' => 3,
            'base_price' => 0,
            'price_per_km' => 0,
        ]);
    }
}
