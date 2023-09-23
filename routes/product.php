<?php

//use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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
//Route::get('/' ,[ProductController::class,'index']);

Route::group([

],function (){
    Route::get('/' ,'\App\Http\Controllers\ProductController@index');
    Route::post('/' ,'\App\Http\Controllers\ProductController@create');
    Route::post('/update' ,'\App\Http\Controllers\ProductController@update');
    Route::delete('/destroy/{id}' ,'\App\Http\Controllers\ProductController@destroy');
    Route::get('/show/{id}' ,'\App\Http\Controllers\ProductController@show');
    Route::get('/{id}/show' ,'\App\Http\Controllers\ProductController@getCategory');
    Route::get('/{id}' ,'\App\Http\Controllers\ProductController@getProduct');
});
