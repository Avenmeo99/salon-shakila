<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransGateway
{
    public static function createSnapToken(array $params): string
    {
        // Ambil konfigurasi dari config/midtrans.php
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        return Snap::getSnapToken($params);
    }
}
