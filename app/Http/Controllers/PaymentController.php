<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Setting;
use App\Models\YandexPayment;
use App\Services\Qiwi\QiwiPay;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class PaymentController
{
    public function pay(Request $request, Product $product)
    {

    }

    public function choose(Request $request, Product $product)
    {
        $yandexWallet = Setting::getYandexWallet();
        $qiwi = new QiwiPay();
        $qiwiLink = $qiwi->getLink($product->price);

        return view('payment.choose', compact('product', 'yandexWallet', 'qiwiLink'));
    }

    public function proceed(Request $request)
    {
        $purchase = new Purchase();
        $purchase->product_id = 1;
        $purchase->customer = $request->get('sender');
        $purchase->generateBillId();
        $purchase->setWaiting();
        $purchase->saveOrFail();
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
        $purchase->bill_id = Uuid::uuid4()->toString();
        $purchase->setWaiting();
        $purchase->saveOrFail();

        return Response::create('', 200);
    }
}