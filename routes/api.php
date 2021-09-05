<?php

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\AppStatisticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\SiteHistoryController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\YoutubeController;
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

    Route::get('/application_history/{child}/{package}', [AppStatisticsController::class, 'index']);
    Route::post('/application_history', [AppStatisticsController::class, 'store']);
    Route::get('/application_history/{child}/{package}/{date}', [AppStatisticsController::class, 'show']);
    Route::patch('/application_history/{application_history}', [AppStatisticsController::class, 'update']);
    Route::delete('/application_history/{application_history}', [AppStatisticsController::class, 'destroy']);

    Route::get('/sites/{child}', [SitesController::class, 'index']);
    Route::post('/sites', [SitesController::class, 'store']);
    Route::get('/sites/{child}/{site}', [SitesController::class, 'show']);
    Route::patch('/sites/{site}', [SitesController::class, 'update']);
    Route::delete('/sites/{site}', [SitesController::class, 'destroy']);

    Route::get('/site_history/{child}/{host}', [SiteHistoryController::class, 'index']);
    Route::post('/site_history', [SiteHistoryController::class, 'store']);
    Route::get('/site_history/{child}/{host}/{date}', [SiteHistoryController::class, 'show']);
    Route::delete('/site_history/{site}', [SiteHistoryController::class, 'destroy']);

    Route::get('/youtube/{child}', [YoutubeController::class, 'index']);
    Route::post('/youtube', [YoutubeController::class, 'store']);
    Route::get('/youtube/{child}/{youtube}', [YoutubeController::class, 'show']);
    Route::patch('/youtube/{youtube}', [YoutubeController::class, 'update']);
    Route::delete('/youtube/{youtube}', [YoutubeController::class, 'destroy']);
});
