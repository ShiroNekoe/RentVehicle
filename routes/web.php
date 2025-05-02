<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\BookingController;
use App\Models\Vehicle;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Dashboard pengguna
Route::middleware('auth')->get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

// Profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk Kendaraan
Route::get('/vehicles/{vehicle}', [RentalController::class, 'show'])->name('vehicles.show');

// Rute untuk Booking
Route::get('/booking/{vehicle}', function (Vehicle $vehicle) {
    return view('booking.create', compact('vehicle'));
})->name('booking.create');

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');

// Rute Pembayaran
Route::get('/payment/redirect/{booking}', [PaymentController::class, 'redirectToMidtrans'])->name('payment.redirect');
Route::post('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');
Route::get('/booking/{booking}/invoice', [BookingController::class, 'downloadInvoice'])->name('booking.invoice');
Route::get('/transfer-confirmation/{amount}', function ($amount) {
    return view('pages.transfer-confirmation', ['total_transfer' => $amount]);
})->name('transfer.confirmation');
Route::post('/midtrans/callback', [PaymentController::class, 'handleCallback']);


//redirect 
Route::get('/booking/success', function () {
    return view('booking.success');
});
Route::get('/booking/pending', function () {
    return view('booking.pending');
});
Route::get('/booking/failed', function () {
    return view('booking.failed');
});


// Google Authentication
use App\Http\Controllers\Auth\GoogleController;
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';
