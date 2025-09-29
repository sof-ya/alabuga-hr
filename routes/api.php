<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::as('api.')->group(function () {
    Route::middleware(['jwt.auth'])->group(function () {
        Route::apiResource('store', StoreController::class)->only(['index']);
        Route::patch('/store/buy/{item}', [StoreController::class, 'buy']);

        Route::apiResource('branches', BranchController::class)->only(['index']);
        Route::get('branches/requirements/{branch}', [BranchController::class, 'requirements']);
    });
});

Route::prefix('auth')->controller(JWTController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
    Route::post('/refresh', 'refresh')->name('refresh');
    Route::post('/me', 'me')->name('me');
});
