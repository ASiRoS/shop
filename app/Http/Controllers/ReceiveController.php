<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Services\Payment\SendAnswer;
use App\Services\Payment\Verifier\QiwiVerifier;
use App\Services\Payment\Verifier\YandexVerifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReceiveController
{
    public function yandex(Request $request, YandexVerifier $verifier, SendAnswer $answer)
    {
        $label = $request->get('label');

        $code = 200;

        if($verifier->verify($request->get('sha1_hash'), $request->all())) {
            $purchase = Purchase::byBillId($label);
            $purchase->setPaid();
            $answer->send($purchase);
        } else {
            $code = 400;
        }

        return Response::make('', $code);
    }

    public function qiwi(Request $request, QiwiVerifier $verifier, SendAnswer $answer)
    {
        $data = json_decode($request->getContent(), true);

        $hash = $request->header('X-Api-Signature-SHA256');

        $bill = $data['bill'];

        $purchase = Purchase::ByBillId($bill['billId']);

        $code = 200;

        if($verifier->verify($hash, $data)) {
            $purchase->setPaid();
            $purchase->save();

            $answer->send($purchase);
        } else {
            $code = 400;
        }

        return Response::make('', $code);
    }
}