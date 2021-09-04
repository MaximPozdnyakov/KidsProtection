<?php

use App\Http\Controllers\ApplicationsController;
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

    Route::get('/applications/{child}', [ApplicationsController::class, 'index']);
    Route::post('/applications', [ApplicationsController::class, 'store']);
    Route::get('/applications/{child}/{application}', [ApplicationsController::class, 'show']);
    Route::post('/applications/{application}', [ApplicationsController::class, 'update']);
    Route::delete('/applications/{application}', [ApplicationsController::class, 'destroy']);

    // Route::get('/application_statistics/{application}', [ApplicationsController::class, 'index']);
    // Route::post('/application_statistics', [ApplicationsController::class, 'store']);
    // Route::get('/application_statistics/{application}/{date}', [ApplicationsController::class, 'show']);
    // Route::patch('/application_statistics/{application}/{date}', [ApplicationsController::class, 'update']);
    // Route::delete('/application_statistics/{application}/{date}', [ApplicationsController::class, 'destroy']);
});
