<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController
{
    public function __invoke(Product $product)
    {
        if(!$product->published) {
            throw new NotFoundHttpException();
        }


        $yandexWallet = Setting::getYandexWallet();
        return view('product.show', compact('product', 'yandexWallet'));
    }
}