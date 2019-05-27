<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController
{
    public function new(Request $request)
    {
        json_decode($request->getContent(), true);

        $product = Product::findOrFail();
        $purchase = new Purchase();
        $purchase->product_id = 1;
        $purchase->customer = $request->get('sender');
        $purchase->generateBillId();
        $purchase->setWaiting();
        $purchase->saveOrFail();
    }
}