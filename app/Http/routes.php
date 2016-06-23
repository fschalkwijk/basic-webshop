<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/product/{product}', 'ProductController@show');

Route::get('/cart/add/{product}/{amount?}', 'CartController@addProduct');
Route::get('/cart/remove/{product}/{amount?}', 'CartController@removeProduct');
Route::get('/cart', 'CartController@show');
Route::post('/cart', 'CartController@checkout');
