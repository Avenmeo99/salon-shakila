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
        'type',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeSingles($query)
    {
        return $query->where('type', 'single');
    }

    public function scopePackages($query)
    {
        return $query->where('type', 'package');
    }

    public function effectivePrice(): int
    {
        return (int) $this->price;
    }

    public function packageItems()
    {
        return $this->belongsToMany(
            self::class,
            'service_package_items',
            'package_id',
            'item_id'
        )->withPivot('qty')->withTimestamps();
    }
}
