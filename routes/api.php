<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\API\GoogleController;



// Auth Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->put('/profile', [AuthController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/forgot-password', [PasswordController::class, 'sendOtp']);
Route::post('/verify-otp', [PasswordController ::class, 'verifyOtp']);
Route::post('/reset-password', [PasswordController::class, 'resetPassword']);
Route::get('login/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Custom Vehicle Type Routes
Route::get('/vehicles/cars', [VehicleController::class, 'cars']);
Route::get('/vehicles/motorcycles', [VehicleController::class, 'motorcycles']);
// Vehicles
Route::get('/vehicles', [VehicleController::class, 'index']);
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show']);

// Bookings
Route::middleware('auth:sanctum')->get('/bookings', [BookingController::class, 'getUserBookings']);
Route::get('/bookings/{booking}', [BookingController::class, 'show']);
Route::middleware('auth:sanctum')->post('/bookings_payment', [BookingController::class, 'store']);
Route::delete('/bookings/{id}', [BookingController::class, 'cancel']);
Route::get('/vehicles/filter-by-booking-status', [BookingController::class, 'filterByBookingStatus']);
Route::middleware('auth:sanctum')->get('/bookings/{id}', [BookingController::class, 'show']);

//Rating
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/reviews/{booking}', [ReviewController::class, 'store']);
});

// Reviews
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{review}', [ReviewController::class, 'show']);
Route::post('/reviews', [ReviewController::class, 'store']);


// Booking cancel route
Route::middleware('auth:sanctum')->delete('/bookings/{id}', [BookingController::class, 'cancel']);

// Payment Route
Route::post('payment/snap-token', [PaymentController::class, 'generateSnapToken']);
Route::post('payments', [PaymentController::class, 'createPayment']);
Route::put('payments/{id}/status', [PaymentController::class, 'updateStatus']);