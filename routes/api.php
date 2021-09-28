<?php

use App\Http\Controllers\AppHistoryController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallSmsHistoryController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\GeolocationController;
use App\Http\Controllers\PhonesController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::middleware(['auth:api', 'contentTypeJson'])->group(function () {
        Route::get('/auth', [AuthController::class, 'index']);
        Route::post('/object', [AuthController::class, 'update']);
        Route::get('/check', [AuthController::class, 'send_email_verification_code']);
        Route::post('/check', [AuthController::class, 'verify_email']);
        Route::get('/logout', [AuthController::class, 'logout']);
    });
    Route::middleware('contentTypeJson')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/restore', [AuthController::class, 'forgot']);
        Route::post('/reset', [AuthController::class, 'reset'])->name('password.reset');
    });
});

Route::middleware(['auth:api', 'checkChild', 'checkSubscription', 'contentTypeJson'])->group(function () {
    Route::get('/child/list', [ChildrenController::class, 'index']);
    Route::post('/child/object', [ChildrenController::class, 'store']);
    Route::get('/child/object', [ChildrenController::class, 'show']);
    Route::put('/child/object', [ChildrenController::class, 'update']);
    Route::delete('/child/object', [ChildrenController::class, 'destroy']);
    Route::post('/child/allapps', [ChildrenController::class, 'updateApps']);

    Route::get('/apps/child', [ApplicationsController::class, 'getAll']);
    Route::get('/apps/list', [ApplicationsController::class, 'getAllWithLimit']);
    Route::get('/apps/blocked', [ApplicationsController::class, 'getBlocked']);
    Route::get('/apps/limit', [ApplicationsController::class, 'getBlockedWithOptions']);
    Route::post('/apps/blocked', [ApplicationsController::class, 'block']);
    Route::put('/apps/blocked', [ApplicationsController::class, 'blockMany']);
    Route::delete('/apps/blocked', [ApplicationsController::class, 'unblock']);
    Route::post('/apps/sync', [ApplicationsController::class, 'sync']);

    Route::get('/apps/story', [AppHistoryController::class, 'index']);
    Route::post('/apps/story', [AppHistoryController::class, 'store']);
    Route::options('/apps/story', [AppHistoryController::class, 'showTimeUse']);

    Route::get('/websites/blocked', [SitesController::class, 'index']);
    Route::post('/websites/blocked', [SitesController::class, 'store']);
    Route::delete('/websites/blocked', [SitesController::class, 'destroy']);

    Route::get('/numberphones/blocked', [PhonesController::class, 'index']);
    Route::post('/numberphones/blocked', [PhonesController::class, 'store']);
    Route::delete('/numberphones/blocked', [PhonesController::class, 'destroy']);

    Route::get('/numberphones/story', [CallSmsHistoryController::class, 'index']);
    Route::post('/numberphones/story', [CallSmsHistoryController::class, 'store']);

    Route::get('/gps/story', [GeolocationController::class, 'index']);
    Route::post('/gps/story', [GeolocationController::class, 'store']);

    Route::get('/support/themes', [SupportController::class, 'index'])->withoutMiddleware(['auth:api', 'checkSubscription']);
    Route::post('/support/object', [SupportController::class, 'store'])->withoutMiddleware(['auth:api', 'checkSubscription']);

    Route::get('/subscribes/list', [SubscriptionController::class, 'index'])->withoutMiddleware('checkSubscription');
    Route::post('/subscribes/object', [SubscriptionController::class, 'store'])->withoutMiddleware('checkSubscription');
    Route::get('/user/subscribe', [SubscriptionController::class, 'getActiveSubscription']);
});
