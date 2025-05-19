<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserHistoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MidtransController;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Http\Livewire\BookingExtend;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\BookingForm;


// Test route
Route::get('/test', function () {
    return Auth::id();
});

// Halaman Utama
Route::get('/', [HomeController::class, 'index']);

// Halaman konfirmasi admin booking
Route::get('/booking/admin-confirmation', function () {
    return view('booking.admin_confirm', [
        'adminPhone' => '6282255479716' // ganti dengan no admin kamu
    ]);
})->name('booking.admin_confirm');

// Middleware auth untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Dashboard dan history user
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/history', [UserHistoryController::class, 'index'])->name('user.history');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pembayaran Midtrans & Transfer Manual
    Route::get('/payment/redirect/{booking}', [PaymentController::class, 'redirectToMidtrans'])->name('payment.redirect');
    Route::get('/midtrans/extend/payment/{booking}', [PaymentController::class, 'extendPayment'])->name('midtrans.extend.payment');

    // Invoice booking
    Route::get('/booking/{booking}/invoice', [BookingController::class, 'downloadInvoice'])->name('booking.invoice');

    // Halaman konfirmasi transfer manual (tanpa parameter)
    Route::get('/transfer-confirmation', function () {
        return view('pages.transfer-confirmation');
    })->name('pages.transfer.confirmation');

    // Review
    Route::get('/review/{booking}', [ReviewController::class, 'create'])->name('user.review');
    Route::post('review/{booking}', [ReviewController::class, 'store'])->name('booking.review.submit');
});

// Kendaraan
Route::get('/vehicles/{vehicle}', [RentalController::class, 'show'])->name('vehicles.show');

// History user booking (optional, sudah ada di group auth)
Route::get('/user/history', [BookingController::class, 'history'])->name('user.history')->middleware('auth');

// Booking Routes
Route::get('/booking/{vehicle}', function (Vehicle $vehicle) {
    return view('booking.create', compact('vehicle'));
})->name('booking.create');

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/booking/detail/{booking}', [BookingController::class, 'show'])->name('user.booking_detail');

Route::put('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

Route::get('/booking/{id}/invoice', [BookingController::class, 'invoice'])->name('invoice.booking');
Route::get('/booking/{vehicleId}', BookingForm::class)->middleware('auth'); 



// Booking extend menggunakan Livewire component (tidak pakai closure)
Route::get('/booking/{booking}/extend', BookingExtend::class)->name('booking.extend');

Route::get('/transfer-confirmation/{booking_id}', [BookingController::class, 'transferConfirmation'])->name('pages.transfer-confirmation');
Route::get('/cod-invoice/{booking_id}', [BookingController::class, 'invoice'])->name('pages.cod-invoice');

Route::get('/transfer/{booking}', [BookingController::class, 'showTransferForm'])->name('transfer.form');
Route::post('/transfer/{booking}', [BookingController::class, 'submitTransfer'])->name('transfer.submit');



// Redirect halaman status booking (view statis)
Route::view('/booking/success', 'booking.success');
Route::view('/booking/pending', 'booking.pending');
Route::view('/booking/failed', 'booking.failed');

// Login Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



// Auth routes Laravel default
require __DIR__.'/auth.php';
