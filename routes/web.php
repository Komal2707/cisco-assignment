<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['as' => 'cisco::', 'prefix' => 'cisco', 'namespace' => 'Cisco'], function () {

    Route::group(['as' => 'router::', 'prefix' => 'router', 'namespace' => 'Router'], function () {

        Route::get('list', [ 'as' => 'list', 'uses' => 'CiscoRouterController@dataTable']);
        // Route::get('list', 'CiscoRouterController@dataTable')->name('list');;

        Route::get('create', [ 'as' => 'create', 'uses' => 'CiscoRouterController@create']);
        Route::get('edit/{router}', [ 'as' => 'edit', 'uses' => 'CiscoRouterController@edit']);
        Route::get('delete/{router}', [ 'as' => 'delete', 'uses' => 'CiscoRouterController@delete']);
        
        Route::post('store', ['as' => 'store', 'uses' => 'CiscoRouterController@store']);
    });
    
    Route::group(['as' => 'geometric::', 'prefix' => 'geometric', 'namespace' => 'Geometric'], function () {
        Route::get('/', [ 'as' => 'show', 'uses' => 'CiscoGeometricController@show']);

    });

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
