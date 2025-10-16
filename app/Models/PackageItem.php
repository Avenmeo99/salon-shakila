<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'item_service_id',
        'qty',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'package_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'item_service_id');
    }
}
