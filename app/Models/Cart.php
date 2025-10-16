<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Models\CartItem;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'user_id',
        'status',
        'subtotal',
        'discount',
        'total',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public static function generateToken(): string
    {
        return Str::uuid()->toString();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function recalc(): void
    {
        $subtotal = $this->items->sum(fn (CartItem $item) => $item->unit_price * $item->qty);
        $this->subtotal = $subtotal;
        $this->discount = $this->discount ?? 0;
        $this->total = max($subtotal - $this->discount, 0);
        $this->save();
    }
}
