<?php
use App\Http\Controllers\API\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('payment/snap-token', [PaymentController::class, 'generateSnapToken']);