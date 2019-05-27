<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/payment/yandex/receive', 'ReceiveController@yandex')->name('payment.receive.yandex');
Route::post('/payment/qiwi/receive', 'ReceiveController@qiwi')->name('payment.receive.qiwi');

Route::post('/payment/purchase/new');