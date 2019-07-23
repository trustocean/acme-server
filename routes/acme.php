<?php

/*
|--------------------------------------------------------------------------
| ACME API
|--------------------------------------------------------------------------
|
| 定义ACME的API
 */

Route::get('/directory', 'DirectoryController@index')->name('acme.directory');

// routes appeared in the directory api response
Route::post('/acme/key-change', 'KeyController@change')->name('acme.key.change');
Route::post('/acme/new-acct', 'AccountController@new')->name('acme.account.new');
Route::any('/acme/new-nonce', 'NonceController@new')->name('acme.nonce.new');
Route::post('/acme/new-order', 'OrderController@new')->name('acme.order.new');
Route::post('/acme/revoke-cert', 'CertController@new')->name('acme.cert.revoke');

// route not appeared in the directory api response
Route::post('/acme/acct/{id}', 'AccountController@new')->name('acme.account.detail');
