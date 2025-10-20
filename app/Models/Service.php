<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'duration_minutes',
        'is_active',
    ];

    // Harga final (jika nanti ada promo)
    public function effectivePrice(): int
    {
        return $this->price;
    }
}
