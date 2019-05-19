<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\YandexPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController
{
    public function pay(Product $product)
    {
        dd($product);
    }

    public function success()
    {
        return ['success' => 'Оптала успешно произведена.'];
    }

    public function verify(Request $request)
    {
        $payment = new YandexPayment($request);

        if(!$payment->isCorrect()) {
            return Response::create('', 400);
        }

        $purchase = new Purchase();
        $purchase->product_id = 1;
        $purchase->customer = $request->get('sender');
        $purchase->saveOrFail();

        return Response::create('', 200);
    }
}