<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\CoreApi;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production', false);
        Config::$isSanitized  = (bool) config('services.midtrans.is_sanitized', true);
        Config::$is3ds        = (bool) config('services.midtrans.is_3ds', true);
    }

    public function createSnapToken(array $params): string
    {
        return Snap::getSnapToken($params);
    }

    /**
     * Create a QRIS charge using Midtrans Core API.
     * Returns the QR code image URL from actions.
     */
    public function createQrisCharge(array $transactionDetails, array $customerDetails = []): array
    {
        $params = [
            'payment_type' => 'gopay',
            'transaction_details' => $transactionDetails,
        ];

        if (!empty($customerDetails)) {
            $params['customer_details'] = $customerDetails;
        }

        $response = CoreApi::charge($params);

        // Extract QR code URL from actions
        $qrUrl = null;
        if (isset($response->actions)) {
            foreach ($response->actions as $action) {
                if ($action->name === 'generate-qr-code') {
                    $qrUrl = $action->url;
                    break;
                }
            }
        }

        return [
            'status' => $response->transaction_status ?? 'unknown',
            'order_id' => $response->order_id ?? null,
            'qr_url' => $qrUrl,
            'raw' => $response,
        ];
    }
}
