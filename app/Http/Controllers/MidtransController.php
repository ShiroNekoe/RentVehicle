<?php

namespace App\Http\Controllers;
use Midtrans\Notification;
use App\Models\Booking;
use Midtrans\Config;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
     public function callback(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notification = new Notification();

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;

        // Ambil ID booking dari orderId
        // Contoh orderId = BOOK-123-1654789
        $parts = explode('-', $orderId);
        $bookingId = $parts[1] ?? null;

        $booking = Booking::find($bookingId);
        if (!$booking) {
            return response('Booking tidak ditemukan', 404);
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $booking->payment_status = 'challenge';
                $booking->booking_status = 'pending';
            } else if ($fraudStatus == 'accept') {
                $booking->payment_status = 'paid';
                $booking->booking_status = 'confirmed';
            }
        } else if ($transactionStatus == 'settlement') {
            $booking->payment_status = 'paid';
            $booking->booking_status = 'confirmed';
        } else if ($transactionStatus == 'pending') {
            $booking->payment_status = 'pending';
            $booking->booking_status = 'pending';
        } else if (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            $booking->payment_status = 'failed';
            $booking->booking_status = 'cancelled';
        }

        $booking->save();

        return response('OK', 200);
    }
}
