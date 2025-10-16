<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTimeblock extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekday',
        'start',
        'end',
        'interval_minutes',
    ];
}
