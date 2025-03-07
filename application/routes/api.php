<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers\Api\V1',
    'prefix' => 'v1',
], function () {
    Route::group(['controller' => AuthController::class], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('/', 'login');
            Route::group(['middleware' => 'auth:api'], function () {
                Route::post('/logout', 'logout');
            });
        });
    });
    Route::apiResource('/users', UserController::class)->except(['store']);//->middleware('auth:api');
    Route::apiResource('/users', UserController::class)->only(['store']);
});