<?php

Route::get('/', 'HomeController')->name('home');

Route::post('/payment/{product}/choose', 'PaymentController@choose')->name('payment.choose');
Route::get('/payment/success', 'PaymentController@success')->name('payment.success');

Route::get('/product/{product}', 'ProductController')->name('product');
