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
    Route::get('/' , '\App\Http\Controllers\CategoryController@index');
});

