<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Services\Payment\SendAnswer;
use App\Services\Qiwi\QiwiPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReceiveController
{
    /**
     * Receives notification from yandex,
     * about payment.
     * @param Request $request
     * @param SendAnswer $sender
     * @return \Illuminate\Http\Response
     */
    public function yandex(Request $request, SendAnswer $sender)
    {
        $label = $request->get('label');

        $purchase = Purchase::byBillId($label);

        $sender->send($purchase->customer, $purchase);

        return Response::make();
    }

    public function qiwi(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $hash = $request->header('X-Api-Signature-SHA256');

        $bill = $data['bill'];

        /**
         * @var Purchase $purchase
         */
        $purchase = Purchase::ByBillId($bill['billId'])->first();

        $invoiceParams = "{$bill['amount']['currency']}|{$bill['amount']['currency']}|{$bill['billId']}|{$bill['siteId']}|{$bill['status']['value']}";

        $signature = hash_hmac('sha256', $invoiceParams, QiwiPay::PRIVATE_KEY);

        if(hash_equals($hash, $signature)) {
            $purchase->setPaid();
            $purchase->save();
        }

        return Response::make();
    }
}