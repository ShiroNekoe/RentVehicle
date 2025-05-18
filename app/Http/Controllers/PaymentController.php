<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

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
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Ambil notification dari Midtrans (otomatis verifikasi signature)
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        // Cari booking berdasarkan order_id Midtrans yang sudah tersimpan di database
        $booking = Booking::where('midtrans_order_id', $orderId)->first();

        if (!$booking) {
            return response()->json(['message' => 'Booking tidak ditemukan'], 404);
        }

        // Update status booking & pembayaran berdasarkan status transaksi Midtrans
        if ($transactionStatus == 'capture') {
            // Jika pembayaran kartu kredit dan statusnya challenge
            if ($fraudStatus == 'challenge') {
                $booking->update([
                    'payment_status' => 'pending',
                    'booking_status' => 'ongoing',
                ]);
            } else {
                // Pembayaran berhasil
                $booking->update([
                    'payment_status' => 'paid',
                    'booking_status' => 'ongoing',
                ]);
            }
        } elseif ($transactionStatus == 'settlement') {
            // Pembayaran berhasil via bank transfer, e-wallet, dll
            $booking->update([
                'payment_status' => 'paid',
                'booking_status' => 'ongoing',
            ]);
        } elseif ($transactionStatus == 'pending') {
            // Pembayaran belum selesai
            $booking->update([
                'payment_status' => 'pending',
                'booking_status' => 'ongoing',
            ]);
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            // Pembayaran gagal atau dibatalkan
            $booking->update([
                'payment_status' => 'failed',
                'booking_status' => 'cancelled',
            ]);
        }

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
