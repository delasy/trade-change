<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('/order-status', 'Api\V1\OrderStatusController@post')->name('api/v1/order-status');
    /*Route::get('/where-next', 'Api\V1\WhereNextController@get')->name('api/v1/where-next');
    Route::get('/available-getin', 'Api\V1\AvailableGetinController@get')->name('api/v1/available-getin');
    Route::get('/available-getout', 'Api\V1\AvailableGetoutController@get')->name('api/v1/available-getout');*/
});

