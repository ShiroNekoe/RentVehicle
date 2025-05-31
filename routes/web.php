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
// use App\Http\Controllers\MidtransController;
use App\Models\Vehicle;
use App\Models\Booking;
use Livewire\Livewire;
use App\Http\Livewire\ExtendBooking;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\BookingForm;
use App\Http\Middleware\IsAdmin;


// Test route
Route::get('/test', function () {
    return Auth::id();
});

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('welcome');


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
Route::get('/transfer/{id}', [PaymentController::class, 'show'])->name('transfer.show');

Route::get('/transfer-confirmation/{booking_id}', [BookingController::class, 'transferConfirmation'])->name('pages.transfer-confirmation');
Route::get('/cod-invoice/{booking_id}', [BookingController::class, 'invoice'])->name('pages.cod-invoice');

Route::get('/transfer/{booking}', [BookingController::class, 'showTransferForm'])->name('transfer.form');
Route::post('/transfer/{booking}', [BookingController::class, 'submitTransfer'])->name('transfer.submit');
Route::get('/booking/{booking}/extend', ExtendBooking::class)->name('extend.booking');
Livewire::component('extend-booking', ExtendBooking::class);
Route::get('/transfer-confirmation-extend/{payment}', function ($paymentId) {
    $payment = \App\Models\Payment::findOrFail($paymentId);
    return view('pages.transfer-confirmation-extend', compact('payment'));
})->name('transfer.confirmation.extend');
Route::post('/payment/process/{payment}', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/success/{payment}', [PaymentController::class, 'success'])->name('payment.success');




// Redirect halaman status booking (view statis)
Route::view('/booking/success', 'booking.success');
Route::view('/booking/pending', 'booking.pending');
Route::view('/booking/failed', 'booking.failed');

// Login Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//middleware admin
// Route::middleware([
//     'auth',
//     IsAdmin::class
// ])->group(function () {
//     Route::get('/admin', function () {
//     });
// });



// Auth routes Laravel default
require __DIR__.'/auth.php';
