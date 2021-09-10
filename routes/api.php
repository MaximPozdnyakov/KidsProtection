<?php

use App\Http\Controllers\AppHistoryController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\GeolocationController;
use App\Http\Controllers\PhonesController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\SmsHistoryController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\YoutubeController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('/auth', [AuthController::class, 'index']);
        Route::post('/object', [AuthController::class, 'update']);
        Route::get('/check', [AuthController::class, 'send_email_verification_code']);
        Route::post('/check', [AuthController::class, 'verify_email']);
        Route::get('/logout', [AuthController::class, 'logout']);
    });
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/restore', [AuthController::class, 'forgot']);
    Route::post('/reset', [AuthController::class, 'reset'])->name('password.reset');
});

Route::middleware(['auth:api', 'checkChild'])->group(function () {
    Route::get('/child/list', [ChildrenController::class, 'index']);
    Route::post('/child/object', [ChildrenController::class, 'store']);
    Route::get('/child/object', [ChildrenController::class, 'show']);
    Route::put('/child/object', [ChildrenController::class, 'update']);
    Route::delete('/child/object', [ChildrenController::class, 'destroy']);

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

    Route::get('/websites/blocked', [SitesController::class, 'index']);
    Route::post('/websites/blocked', [SitesController::class, 'store']);
    Route::delete('/websites/blocked', [SitesController::class, 'destroy']);

    Route::get('/youtube/blocked', [YoutubeController::class, 'index']);
    Route::post('/youtube/blocked', [YoutubeController::class, 'store']);
    Route::delete('/youtube/blocked', [YoutubeController::class, 'destroy']);

    Route::get('/phones/{child}', [PhonesController::class, 'index']);
    Route::post('/phones', [PhonesController::class, 'store']);
    Route::get('/phones/{child}/{phone}', [PhonesController::class, 'show']);
    Route::patch('/phones/{phone}', [PhonesController::class, 'update']);
    Route::delete('/phones/{phone}', [PhonesController::class, 'destroy']);

    Route::get('/sms/{child}/{phone}', [SmsHistoryController::class, 'index']);
    Route::post('/sms', [SmsHistoryController::class, 'store']);
    Route::get('/sms/{child}/{phone}/{date}', [SmsHistoryController::class, 'show']);
    Route::delete('/sms/{sms}', [SmsHistoryController::class, 'destroy']);

    Route::get('/gps/story', [GeolocationController::class, 'index']);
    Route::post('/gps/story', [GeolocationController::class, 'store']);

    Route::get('/support/themes', [SupportController::class, 'index']);
    Route::post('/support/object', [SupportController::class, 'store']);

    Route::get('/subscribes/list', [SubscriptionController::class, 'index']);
    Route::post('/subscriptions', [SubscriptionController::class, 'store']);
});
