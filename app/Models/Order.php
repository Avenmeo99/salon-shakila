<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id','user_id','cart_token',
        'subtotal','discount','tips','grand_total',
        'status','payment_type','transaction_id','fraud_status',
        'paid_at','raw_payload','signature_key',
    ];

    protected $casts = [
        'subtotal'    => 'integer',
        'discount'    => 'integer',
        'tips'        => 'integer',
        'grand_total' => 'integer',
        'paid_at'     => 'datetime',
        'raw_payload' => 'array',
    ];
}
