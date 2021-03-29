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

Route::middleware('auth:api')->get('/user', 'AuthController@userInfo');
Route::get('categories/random/{count}', 'CategoryController@random');
Route::get('categories/slug/{slug}', 'CategoryController@slug');
Route::apiResource('categories', 'CategoryController');
Route::get('books/top/{count}', 'BookController@top');
Route::get('books/slug/{slug}', 'BookController@slug');
Route::get('books/search/{keyword}', 'BookController@search');
Route::apiResource('books', 'BookController');
Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', 'AuthController@logout');
});
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::get('cities', 'ShopController@cities');
Route::get('provinces', 'ShopController@provinces');
Route::post('shipping', 'ShopController@shipping');
Route::get('couriers', 'ShopController@couriers');
Route::post('services', 'ShopController@services');
