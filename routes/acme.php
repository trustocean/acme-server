<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| ACME API
|--------------------------------------------------------------------------
|
| 定义ACME的API
 */

Route::get('/directory', 'DirectoryController@index')->name('acme.directory');

Route::post('/acme/key-change', 'KeyController@change')->name('acme.key.change');
Route::post('/acme/new-acct', 'AccountController@new')->name('acme.account.new');
Route::post('/acme/new-nonce', 'NonceController@new')->name('acme.nonce.new');
Route::post('/acme/new-order', 'OrderController@new')->name('acme.order.new');
Route::post('/acme/revoke-cert', 'CertController@new')->name('acme.cert.revoke');
