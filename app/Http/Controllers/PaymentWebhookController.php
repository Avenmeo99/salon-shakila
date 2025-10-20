<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaymentWebhookController extends Controller
{
    public function midtrans(Request $request)
    {
        $payload = $request->all();

        // 1) Validasi signature (WAJIB)
        $serverKey    = config('midtrans.server_key');
        $calcSignature = hash('sha512',
            ($payload['order_id'] ?? '') .
            ($payload['status_code'] ?? '') .
            ($payload['gross_amount'] ?? '') .
            $serverKey
        );

        if (($payload['signature_key'] ?? '') !== $calcSignature) {
            Log::warning('Midtrans invalid signature', ['payload' => $payload]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $orderId        = $payload['order_id'] ?? null;
        $transactionId  = $payload['transaction_id'] ?? null;
        $paymentType    = $payload['payment_type'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? 'pending'; // capture|settlement|pending|deny|cancel|expire
        $fraudStatus    = $payload['fraud_status'] ?? null;
        $grossAmountStr = $payload['gross_amount'] ?? '0';

        // Midtrans kirim gross_amount string (boleh "10000.00"). Kita ubah ke integer rupiah.
        $grossAmount = (int) round(floatval($grossAmountStr));

        if (!$orderId) {
            Log::warning('Midtrans callback without order_id', $payload);
            return response()->json(['message' => 'Missing order_id'], 400);
        }

        // 2) Update order secara atomik
        DB::beginTransaction();
        try {
            $order = Order::lockForUpdate()->where('order_id', $orderId)->first();

            if (!$order) {
                // Jika order belum ada (harusnya dibuat saat checkout.index), log dan buat entri minimal.
                $order = Order::create([
                    'order_id'     => $orderId,
                    'status'       => 'pending',
                    'grand_total'  => $grossAmount, // fallback
                ]);
                Log::warning('Order not found; created minimal stub', ['order_id' => $orderId]);
            }

            // 3) Validasi nominal (opsional tapi disarankan)
            if ($order->grand_total > 0 && $grossAmount !== (int) $order->grand_total) {
                Log::warning('Midtrans amount mismatch', [
                    'order_id' => $orderId,
                    'expected' => $order->grand_total,
                    'got'      => $grossAmount,
                ]);
                // Bisa return 422; tapi kebanyakan merchant tetap terima dan investigasi manual.
                // return response()->json(['message' => 'Amount mismatch'], 422);
            }

            // 4) Map status midtrans → status internal
            $newStatus = match ($transactionStatus) {
                'capture', 'settlement' => 'paid',
                'pending'               => 'pending',
                'deny'                  => 'deny',
                'cancel'                => 'canceled',
                'expire'                => 'expired',
                default                 => 'pending',
            };

            // Idempotency: jika sudah 'paid', jangan downgrade ke status kecil
            if ($order->status === 'paid') {
                // tetap update info payment (raw payload), tapi status tidak diganti
                $order->payment_type   = $paymentType ?? $order->payment_type;
                $order->transaction_id = $transactionId ?? $order->transaction_id;
                $order->fraud_status   = $fraudStatus ?? $order->fraud_status;
                $order->signature_key  = $payload['signature_key'] ?? $order->signature_key;
                $order->raw_payload    = $payload;
                $order->save();

                DB::commit();
                return response()->json(['ok' => true, 'message' => 'Already paid']);
            }

            // Update status + cap paid_at kalau paid
            $order->status         = $newStatus;
            $order->payment_type   = $paymentType;
            $order->transaction_id = $transactionId;
            $order->fraud_status   = $fraudStatus;
            $order->signature_key  = $payload['signature_key'] ?? null;
            $order->raw_payload    = $payload;

            if ($newStatus === 'paid' && !$order->paid_at) {
                $order->paid_at = now();
            }

            $order->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Midtrans webhook error', ['e' => $e, 'payload' => $payload]);
            return response()->json(['message' => 'Server error'], 500);
        }

        return response()->json(['ok' => true]);
    }
}
