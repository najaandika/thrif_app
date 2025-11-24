<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerAddress extends Model
{
    use HasFactory;

    /**
     * Kolom mass-assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'recipient_name',
        'phone',
        'address_line',
        'city',
        'province',
        'postal_code',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formatted(): string
    {
        $parts = array_filter([
            $this->address_line,
            $this->city,
            $this->province,
            $this->postal_code,
        ]);

        return implode(', ', $parts);
    }

    public function asTextarea(): string
    {
        $secondLine = trim(implode(' ', array_filter([
            $this->city,
            $this->province,
            $this->postal_code,
        ])));

        return trim(implode("\n", array_filter([
            $this->address_line,
            $secondLine,
        ])));
    }
}
