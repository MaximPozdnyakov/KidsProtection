<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChildrenController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('/', [AuthController::class, 'index']);
        Route::get('/logout', [AuthController::class, 'logout']);
    });
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot', [AuthController::class, 'forgot']);
    Route::post('/reset', [AuthController::class, 'reset'])->name('password.reset');
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('children', ChildrenController::class);
});
