<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function redirectToMidtrans(Booking $booking)
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'BOOKING-' . $booking->id,
                'gross_amount' => $booking->booking_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,  // Memperbaiki penggunaan Auth
                'email' => Auth::user()->email,  // Memperbaiki penggunaan Auth
            ],
        ];

        // Mendapatkan Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Mengirimkan snapToken ke view
        return view('payment.midtrans', compact('snapToken'));
    }

    public function handleCallback(Request $request)
    {
        // Verifikasi Signature dari Midtrans
        $serverKey = config('midtrans.serverKey');
        $signature = hash('sha512', 
            $request->order_id . 
            $request->status_code . 
            $request->gross_amount . 
            $serverKey
        );

        // Mengecek apakah signature valid
        if ($signature !== $request->signature_key) {
            return response()->json(['message' => 'Signature tidak valid'], 403);
        }

        // Mencari booking berdasarkan order_id
        $bookingId = (int) str_replace('BOOKING-', '', $request->order_id);
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['message' => 'Booking tidak ditemukan'], 404);
        }

        // Memperbarui status pembayaran berdasarkan status transaksi dari Midtrans
        if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
            $booking->update(['payment_status' => 'paid']);
        } elseif ($request->transaction_status == 'expire') {
            $booking->update(['payment_status' => 'expired']);
        } elseif ($request->transaction_status == 'cancel' || $request->transaction_status == 'deny') {
            $booking->update(['payment_status' => 'failed']);
        }

        // Log callback dari Midtrans
        Log::info('Midtrans Callback', $request->all());

        // Mengirimkan response JSON ke Midtrans
        return response()->json(['message' => 'Callback diproses'], 200);
    }
}
