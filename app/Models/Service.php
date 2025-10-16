<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Models\PackageItem;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'price',
        'duration_minutes',
        'description',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    public function packageItems(): HasMany
    {
        return $this->hasMany(PackageItem::class, 'package_id');
    }

    public function includedInPackages(): HasMany
    {
        return $this->hasMany(PackageItem::class, 'item_service_id');
    }

    public function isPackage(): bool
    {
        return $this->type === 'package';
    }

    public function effectivePrice(): float
    {
        if (! $this->isPackage()) {
            return (float) ($this->price ?? 0);
        }

        if (! is_null($this->price)) {
            return (float) $this->price;
        }

        return (float) $this->packageItems->sum(function (PackageItem $item) {
            $service = $item->item;

            return ($service ? $service->effectivePrice() : 0) * $item->qty;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
