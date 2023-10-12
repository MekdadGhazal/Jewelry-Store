<?php

//use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 *  All Route Here Start with [api/product]
 *
 *  changed in:
 *      1. \App\Providers\RouteServiceProvider
 *      2. \config\auth.php
 */

Route::group([

],function (){
    Route::get('/' ,'\App\Http\Controllers\Product\ProductController@index');
    Route::get('/show/{id}' ,'\App\Http\Controllers\Product\ProductController@show');
    Route::get('/{id}/show' ,'\App\Http\Controllers\Product\ProductController@getCategory');
    Route::get('/{id}' ,'\App\Http\Controllers\Product\ProductController@getProduct');
});

/**
 *  All Routes below need Authentication
 */

Route::group([
//    'middleware' => 'auth:api',
],function (){
    Route::post('/' ,'\App\Http\Controllers\Product\ProductController@create');
    Route::post('/update' ,'\App\Http\Controllers\Product\ProductController@update');
    Route::delete('/destroy/{id}' ,'\App\Http\Controllers\Product\ProductController@destroy');
});
