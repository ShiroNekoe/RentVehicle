<?php

use App\Http\Controllers\API\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ReviewController;

    // Auth
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('vehicles', VehicleController::class)->only(['index', 'show']);
        Route::apiResource('bookings', BookingController::class)->only(['index', 'show', 'store']);
        Route::apiResource('reviews', ReviewController::class)->only(['index', 'show', 'store']);
        Route::middleware('auth:sanctum')->delete('/bookings/{id}', [BookingController::class, 'cancel']);

    });

Route::post('payment/snap-token', [PaymentController::class, 'generateSnapToken']);