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
use App\Models\Vehicle;

// =======================
// ✅ Halaman Utama
// =======================
Route::get('/', [HomeController::class, 'index']);

// =======================
// ✅ Autentikasi & Dashboard User
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/history', [UserHistoryController::class, 'index'])->name('user.history');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =======================
// ✅ Kendaraan
// =======================
Route::get('/vehicles/{vehicle}', [RentalController::class, 'show'])->name('vehicles.show');

// =======================
// ✅ Booking
// =======================
Route::middleware('auth')->group(function () {
    // Halaman form booking
    Route::get('/booking/{vehicle}', function (Vehicle $vehicle) {
        return view('booking.create', compact('vehicle'));
    })->name('booking.create');

    // Menyimpan booking baru
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

    // Menampilkan detail booking
    Route::get('/booking/detail/{booking}', [BookingController::class, 'show'])->name('user.booking_detail');

    // Membatalkan booking
    Route::put('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
});

// =======================
// ✅ Pembayaran (Midtrans & Manual Transfer)
// =======================
Route::middleware('auth')->group(function () {
    // Redirect ke Midtrans
    Route::get('/payment/redirect/{booking}', [PaymentController::class, 'redirectToMidtrans'])->name('payment.redirect');

    // Invoice
    Route::get('/booking/{booking}/invoice', [BookingController::class, 'downloadInvoice'])->name('booking.invoice');

    // Halaman konfirmasi transfer manual
    Route::get('/transfer-confirmation/{amount}', function ($amount) {
        return view('pages.transfer-confirmation', ['total_transfer' => $amount]);
    })->name('transfer.confirmation');
});

// Callback Midtrans (tidak perlu pakai middleware)
Route::post('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');
Route::post('/midtrans/callback', [PaymentController::class, 'handleCallback']); // duplikat untuk jaga-jaga

// Halaman sukses/gagal pembayaran
Route::get('/payment/success/{order_id}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failed/{order_id}', [PaymentController::class, 'failed'])->name('payment.failed');

// Redirect halaman status booking
Route::view('/booking/success', 'booking.success');
Route::view('/booking/pending', 'booking.pending');
Route::view('/booking/failed', 'booking.failed');

// =======================
// ✅ Login Google
// =======================
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// =======================
// ✅ File Auth Laravel (Login, Register, dll)
// =======================

Route::middleware(['auth'])->group(function () {
    Route::get('/review/{booking}', [ReviewController::class, 'create'])->name('user.review');
    Route::post('review/{booking}', [ReviewController::class, 'store'])->name('booking.review.submit');
});


require __DIR__.'/auth.php';
