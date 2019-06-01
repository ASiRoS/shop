<?php

use App\Mail\SendAnswerMail;

Route::get('/', 'HomeController')->name('home');

Route::post('/payment/{product}/choose', 'PaymentController@choose')->name('payment.choose');
Route::get('/payment/success', 'PaymentController@success')->name('payment.success');

Route::get('/product/{product}', 'ProductController')->name('product');

Route::get('/test', function() {
    \Illuminate\Support\Facades\Mail::to('takahiroasiro@gmail.com')->send(new \App\Mail\Test());
});