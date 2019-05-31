<?php

namespace App\Services\Payment\Verifier;

use App\Services\Qiwi\QiwiPay;

class QiwiVerifier
{
    public function verify(string $hash, array $data): bool
    {
        $bill = $data['bill'];

        $invoiceParams = "{$bill['amount']['currency']}|{$bill['amount']['currency']}|{$bill['billId']}|{$bill['siteId']}|{$bill['status']['value']}";

        $signature = hash_hmac('sha256', $invoiceParams, QiwiPay::PRIVATE_KEY);

        return hash_equals($hash, $signature);
    }
}