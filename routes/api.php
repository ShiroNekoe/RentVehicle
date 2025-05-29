<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\PaymentController;

// Auth Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->put('/profile', [AuthController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Custom Vehicle Type Routes
Route::get('/vehicles/cars', [VehicleController::class, 'cars']);
Route::get('/vehicles/motorcycles', [VehicleController::class, 'motorcycles']);

// Resource Routes
Route::apiResource('vehicles', VehicleController::class)->only(['index', 'show']);
Route::apiResource('bookings', BookingController::class)->only(['index', 'show', 'store']);
Route::apiResource('reviews', ReviewController::class)->only(['index', 'show', 'store']);

// Booking cancel route
Route::middleware('auth:sanctum')->delete('/bookings/{id}', [BookingController::class, 'cancel']);

// Payment Route
Route::post('payment/snap-token', [PaymentController::class, 'generateSnapToken']);