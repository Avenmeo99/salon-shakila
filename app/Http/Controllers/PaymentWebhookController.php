<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentWebhookController extends Controller
{
    public function midtrans(Request $request): Response
    {
        // Stub webhook handler: log payload or trigger payment verification here in the future.
        return response()->noContent();
    }
}
