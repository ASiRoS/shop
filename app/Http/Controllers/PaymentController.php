<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Setting;
use App\Services\Qiwi\QiwiPay;
use Illuminate\Http\Request;

class PaymentController
{
    public function choose(Request $request, Product $product)
    {
        $this->makePurchase($request, $product);

        $yandexWallet = Setting::getYandexWallet();
        $qiwi = new QiwiPay();
        $qiwiLink = $qiwi->getLink($product->price);

        return view('payment.choose', compact('product', 'yandexWallet', 'qiwiLink'));
    }

    private function makePurchase(Request $request, Product $product)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $purchase = new Purchase();
        $purchase->product_id = $product->id;
        $purchase->customer = $request->get('email');
        $purchase->generateBillId();
        $purchase->setWaiting();
        $purchase->saveOrFail();
    }
    
    public function success()
    {
        return view('payment.success');
    }
}