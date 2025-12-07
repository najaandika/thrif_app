<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    /**
     * Kolom mass-assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'recipient_name',
        'phone',
        'address_line',
    ];
}
