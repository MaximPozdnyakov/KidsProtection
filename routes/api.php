<?php

use App\Http\Controllers\AppHistoryController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallHistoryController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\GeolocationController;
use App\Http\Controllers\PhonesController;
use App\Http\Controllers\SiteHistoryController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\SmsHistoryController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\YoutubeHistoryController;
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

    Route::get('/application_history/{child}/{package}', [AppHistoryController::class, 'index']);
    Route::post('/application_history', [AppHistoryController::class, 'store']);
    Route::get('/application_history/{child}/{package}/{date}', [AppHistoryController::class, 'show']);
    Route::patch('/application_history/{application_history}', [AppHistoryController::class, 'update']);
    Route::delete('/application_history/{application_history}', [AppHistoryController::class, 'destroy']);

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

    Route::get('/youtube_history/{child}/{channel}', [YoutubeHistoryController::class, 'index']);
    Route::post('/youtube_history', [YoutubeHistoryController::class, 'store']);
    Route::get('/youtube_history/{child}/{channel}/{date}', [YoutubeHistoryController::class, 'show']);
    Route::delete('/youtube_history/{youtube}', [YoutubeHistoryController::class, 'destroy']);

    Route::get('/phones/{child}', [PhonesController::class, 'index']);
    Route::post('/phones', [PhonesController::class, 'store']);
    Route::get('/phones/{child}/{phone}', [PhonesController::class, 'show']);
    Route::patch('/phones/{phone}', [PhonesController::class, 'update']);
    Route::delete('/phones/{phone}', [PhonesController::class, 'destroy']);

    Route::get('/calls/{child}/{phone}', [CallHistoryController::class, 'index']);
    Route::post('/calls', [CallHistoryController::class, 'store']);
    Route::get('/calls/{child}/{phone}/{date}', [CallHistoryController::class, 'show']);
    Route::delete('/calls/{call}', [CallHistoryController::class, 'destroy']);

    Route::get('/sms/{child}/{phone}', [SmsHistoryController::class, 'index']);
    Route::post('/sms', [SmsHistoryController::class, 'store']);
    Route::get('/sms/{child}/{phone}/{date}', [SmsHistoryController::class, 'show']);
    Route::delete('/sms/{sms}', [SmsHistoryController::class, 'destroy']);

    Route::get('/geolocation/{child}', [GeolocationController::class, 'index']);
    Route::post('/geolocation', [GeolocationController::class, 'store']);
    Route::get('/geolocation/{child}/{date}', [GeolocationController::class, 'show']);
    Route::delete('/geolocation/{geolocation}', [GeolocationController::class, 'destroy']);
});
