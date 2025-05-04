<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function redirectToMidtrans($bookingId)
    {
        // Ambil booking dari database
        $booking = Booking::findOrFail($bookingId);
    
        // Set konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
    
        // Detil transaksi
        $transactionDetails = [
            'order_id' => 'order_' . $booking->id,
            'gross_amount' => $booking->total_price,
        ];
    
        // Detil item
        $itemDetails = [
            [
                'id' => 'item_' . $booking->id,
                'price' => $booking->booking_price,
                'quantity' => 1,
                'name' => 'Booking ' . $booking->vehicle->name
            ]
        ];
    
        // Detil customer
        $customerDetails = [
            'first_name' => $booking->user->name,
            'email' => $booking->user->email,
            'phone' => $booking->user->phone,
        ];
    
        // Create transaksi
        $params = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];
    
        try {
            // Dapatkan token untuk Snap Midtrans
            $snapToken = Snap::getSnapToken($params);
            if (!$snapToken) {
                throw new \Exception("Failed to get Snap Token");
            }
            return view('payment.midtrans', compact('snapToken'));
        } catch (\Exception $e) {
            Log::error('Midtrans error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function handleCallback(Request $request)
    {
        // Ambil data dari Midtrans notification
        $notification = new Notification();

        // Tentukan status pembayaran
        $status = $notification->transaction_status;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        // Cari booking berdasarkan order_id
        $booking = Booking::where('order_id', $orderId)->first();

        // Proses status pembayaran
        if ($status == 'capture') {
            if ($fraudStatus == 'challenge') {
                // Pembayaran challenge
                $booking->status = 'failed';
            } else {
                // Pembayaran berhasil
                $booking->status = 'complete';
                $booking->payment_status = 'paid';
            }
        } elseif ($status == 'settlement') {
            // Pembayaran sudah berhasil
            $booking->status = 'complete';
            $booking->payment_status = 'paid';
        } elseif ($status == 'pending') {
            // Pembayaran menunggu
            $booking->status = 'pending';
        } elseif ($status == 'deny') {
            // Pembayaran gagal
            $booking->status = 'failed';
        }

        // Simpan status pembayaran
        $booking->save();

        return redirect()->route('booking.details', $booking->id);
    }
}
