<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Authenticate\AuthenticateController;
use \App\Http\Controllers\Api\Follow\FollowController;

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

Route::controller(AuthenticateController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('follow', [FollowController::class, 'follow']);
    Route::post('unfollow', [FollowController::class, 'unfollow']);
});
