<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // Redirect pembayaran booking biasa ke Midtrans
    public function redirectToMidtrans(Booking $booking)
    {
        if ($booking->payment_status == 'paid') {
            return redirect()->route('user.dashboard')->with('message', 'Booking sudah dibayar.');
        }

        $params = [
            'transaction_details' => [
                'order_id' => 'BOOKING-' . $booking->id,
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
            ],
            'callbacks' => [
                'finish' => route('payment.success', ['order_id' => 'BOOKING-' . $booking->id]),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.midtrans', compact('snapToken', 'booking'));
    }

    // Extend payment: pembayaran perpanjangan booking
    public function extendPayment(Booking $booking)
    {
        // Ambil data perpanjangan dari session
        $newEndDate = session('extend_new_end_date');
        $extendPrice = session('extend_price');

        if (!$newEndDate || !$extendPrice) {
            return redirect()->route('booking.extend', $booking->id)
                ->withErrors('Data perpanjangan tidak ditemukan. Silakan ulangi.');
        }

        $params = [
            'transaction_details' => [
                'order_id' => 'EXTEND-' . $booking->id . '-' . time(),
                'gross_amount' => $extendPrice,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
            ],
            'callbacks' => [
                'finish' => route('payment.success', ['order_id' => 'EXTEND-' . $booking->id . '-' . time()]),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.midtrans_extend', compact('snapToken', 'booking', 'newEndDate', 'extendPrice'));
    }

    // Handle callback pembayaran dari Midtrans (notifikasi pembayaran)
    public function handleCallback(Request $request)
    {
        // Implementasi handle callback Midtrans
        // Update status pembayaran dan booking sesuai notification

        // Contoh singkat:
        $notification = $request->all();
        // Cek status dan update database...

        return response()->json(['status' => 'ok']);
    }

    // Halaman sukses pembayaran
    public function success($order_id)
    {
        return view('payment.success', compact('order_id'));
    }

    // Halaman gagal pembayaran
    public function failed($order_id)
    {
        return view('payment.failed', compact('order_id'));
    }
}
