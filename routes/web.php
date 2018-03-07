<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@get')->name('index');
Route::get('/exchange', 'IndexController@get')->name('exchange');
Route::post('/exchange', 'IndexController@post');

Route::get('/about-service', 'AboutServiceController@get')->name('about-service');
Route::get('/terms-of-service', 'TermsOfServiceController@get')->name('terms-of-service');

Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function () {
    // Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    // Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    // Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('/signin', 'Auth\SigninController@get')->name('auth/signin');
    Route::post('/signin', 'Auth\SigninController@post');
    Route::get('/signup', 'Auth\SignupController@get')->name('auth/signup');
    Route::post('/signup', 'Auth\SignupController@post');
});

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {
    Route::get('/signout', 'Auth\SignoutController@get')->name('auth/signout');

    Route::get('/', 'Account\IndexController@get')->name('account/index');
    Route::get('/settings', 'Account\SettingsController@get')->name('account/settings');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth.super-admin'], function () {
    Route::get('/', 'Admin\IndexController@get')->name('admin/index');

    Route::get('/curr', 'Admin\CurrController@get')->name('admin/curr');
    Route::get('/curr/deactivated', 'Admin\CurrController@deactivated')->name('admin/curr/deactivated');
    Route::get('/curr/activate/{id}', 'Admin\CurrController@activate');
    Route::get('/curr/add', 'Admin\CurrController@add')->name('admin/curr/add');
    Route::post('/curr/add', 'Admin\CurrController@addpost');
    Route::get('/curr/edit/{id}', 'Admin\CurrController@edit');
    Route::post('/curr/edit/{id}', 'Admin\CurrController@editpost');
    Route::get('/curr/deactivate/{id}', 'Admin\CurrController@deactivate');

    Route::get('/ex-curr', 'Admin\ExCurrController@get')->name('admin/ex-curr');
    Route::get('/ex-curr/deactivated', 'Admin\ExCurrController@deactivated')->name('admin/ex-curr/deactivated');
    Route::get('/ex-curr/activate/{id}', 'Admin\ExCurrController@activate');
    Route::get('/ex-curr/add', 'Admin\ExCurrController@add')->name('admin/ex-curr/add');
    Route::post('/ex-curr/add', 'Admin\ExCurrController@addpost');
    Route::get('/ex-curr/edit/{id}', 'Admin\ExCurrController@edit');
    Route::get('/ex-curr/edit/{id}/deactivated', 'Admin\ExCurrController@editdeactivated');
    Route::post('/ex-curr/edit/{id}', 'Admin\ExCurrController@editpost');
    Route::get('/ex-curr/deactivate/{id}', 'Admin\ExCurrController@deactivate');

    Route::get('/ex-curr/in/add/{id}', 'Admin\ExCurrInController@add');
    Route::get('/ex-curr/in/add-all/{id}', 'Admin\ExCurrInController@add_all');
    Route::post('/ex-curr/in/add/{id}', 'Admin\ExCurrInController@addpost');
    Route::get('/ex-curr/in/deactivate/{id}', 'Admin\ExCurrInController@deactivate');
    Route::get('/ex-curr/in/activate/{id}', 'Admin\ExCurrInController@activate');

    Route::get('/curr-input', 'Admin\CurrInputController@get')->name('admin/curr-input');
    Route::get('/curr-input/add', 'Admin\CurrInputController@add')->name('admin/curr-input/add');
    Route::post('/curr-input/add', 'Admin\CurrInputController@addpost');
    Route::get('/curr-input/look/{id}', 'Admin\CurrInputController@look');
    Route::post('/curr-input/look/{id}', function () { return redirect()->route('admin/curr-input'); });
});
