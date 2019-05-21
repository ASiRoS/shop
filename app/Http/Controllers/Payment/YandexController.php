<?php

namespace App\Http\Controllers\Payment;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class YandexController
{
    /**
     * Receives notification from yandex,
     * about payment.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function receive(Request $request)
    {
        $label = $request->get('label');

        $informations = explode('|', $label);

        $email = $informations[0];
        $productId = $informations[1];
        $product = Product::findOrFail($productId);

        $purchase = new Purchase();
        $purchase->product_id = $productId;
        $purchase->customer = $email;
        $purchase->save();

        return Response::make();
    }
}