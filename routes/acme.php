<?php

/*
|--------------------------------------------------------------------------
| ACME API
|--------------------------------------------------------------------------
|
| 定义ACME的API
*/

# Route::get('/', 'HomeController@index');

Route::get('/directory', 'DirectoryController@index')->name('acme.directory');

// routes appeared in the directory api response
Route::post('/acme/new-acct', 'AccountController@create')->name('acme.account.new');
Route::any('/acme/new-nonce', 'NonceController@create')->name('acme.nonce.new');

Route::group(['middleware' => 'auth',], function () {
    Route::post('/acme/key-change', 'KeyController@change')->name('acme.key.change');
    Route::post('/acme/new-order', 'OrderController@create')->name('acme.order.new');
    Route::any('/acme/order/{id}', 'OrderController@detail')->name('acme.account.order_detail');
    Route::any('/acme/order/{id}/authz/detail/{domain}', 'OrderController@authzDetail')->name('acme.account.authz_detail');
    Route::any('/acme/order/{id}/authz/submit/{domain}', 'OrderController@authzSubmit')->name('acme.account.authz_submit');
    Route::post('/acme/order/{id}/authz/finalize', 'OrderController@authzFinalize')->name('acme.account.authz_finalize');
    Route::any('/acme/order/{id}/cert', 'OrderController@retriveCert')->name('acme.order.retrive_cert');
    Route::post('/acme/revoke-cert', 'CertController@new')->name('acme.cert.revoke');
});

// route not appeared in the directory api response
Route::post('/acme/acct/{id}', 'AccountController@detail')->name('acme.account.detail');

Route::post('/acme/issue-push', 'OrderController@issuePush')->name('acme.issue.push');
