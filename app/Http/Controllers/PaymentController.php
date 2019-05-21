<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Setting;
use App\Models\YandexPayment;
use App\Services\Qiwi\CheckCommand;
use App\Services\Qiwi\PayCommand;
use Fruitware\QiwiServiceProvider\Model\Request\RequestInterface;
use Fruitware\QiwiServiceProvider\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController
{
    private const TYPES = [
        'default' => 'yandex',
        'types' => ['yandex', 'qiwi'],
    ];


    public function pay(Request $request, Product $product)
    {
        $type = $request->query->get('type');
        $type = $type && in_array($type, self::TYPES['types']) ? $type : self::TYPES['default'];

        $service = new Service([
            '127.0.0.1',
        ], [
            'check' => CheckCommand::class,
            'pay' => PayCommand::class,
        ]);

        /**
         * @var RequestInterface $method
         */
        $method = $service->handleRequest(['command' => 'pay']);
        $xmlResponseString = $method->process()->xml()->asXML();

        echo $xmlResponseString;
    }

    public function choose(Product $product)
    {
        $yandexWallet = Setting::getYandexWallet();

        return view('payment.choose', compact('product', 'yandexWallet'));
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