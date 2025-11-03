<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
        'name','slug','description','price',
        'duration_minutes','is_active','type'
    ];

    // scopes aman (kolom boleh belum ada; query tetap berjalan)
    public function scopeActive($q){ return $q->where('is_active', 1); }
    public function scopeSingles($q){ return $q->where('type','single'); }
    public function scopePackages($q){ return $q->where('type','package'); }

    public function effectivePrice(): int { return (int) $this->price; }

    // relasi paket (opsional)
    public function packageItems()
    {
        return $this->belongsToMany(
            self::class, 'service_package_items', 'package_id', 'item_id'
        )->withPivot('qty')->withTimestamps();
=======
        'name', 'slug', 'description', 'price', 'image_url',
    ];

    public function effectivePrice(): int
    {
        return (int) $this->price;
>>>>>>> 198812f (First commit - upload salon_shakila project)
    }
}
