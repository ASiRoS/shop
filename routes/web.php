<?php

Route::get('/', 'HomeController')->name('home');

Route::get('/payment/{product}', 'PaymentController@pay')->name('payment.pay');
Route::get('/payment/{product}/choose', 'PaymentController@choose')->name('payment.choose');
Route::get('/payment/success', 'PaymentController@success')->name('payment.success');

Route::get('/product/{product}', 'ProductController')->name('product');

Route::get('/test', 'TestController')->name('test');
