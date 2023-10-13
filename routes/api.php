<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
| all API here start with [api]
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\CustomerController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
//
//Route::get('/user', [AuthController::class, 'userProfile'])->middleware(['active','api']);
//Route::post('/delete/{id}' ,[AuthController::class, 'destroy']);

/**
 *  Countries
 */
Route::get('/loc', [CountryController::class, 'index']);
Route::get('/send', [\App\Http\Controllers\CustomerController::class, 'sendPurchaseMail']);
