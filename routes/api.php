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


Route::post('login', 'Api\PassportController@login');
Route::post('register', 'Api\PassportController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('get-details', 'Api\PassportController@getDetails');
});

Route::group(['middleware' => 'auth:api', 'as' => 'router::', 'prefix' => 'router'], function () {

    Route::post('create', 'Api\CiscoRouterController@create');
    Route::post('update/{ip}', 'Api\CiscoRouterController@update');
    Route::post('delete/{ip}', 'Api\CiscoRouterController@delete');
    Route::post('get-details-by-ip-range', 'Api\CiscoRouterController@getRoutersByIPRange');
    Route::post('get-details-by-type-sapid', 'Api\CiscoRouterController@getRoutersByTypeAndSapId');

});