<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;

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
           'gross_amount' => $booking->total_price, // Total harga untuk kendaraan sewa
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
            return view('payment.midtrans', compact('snapToken'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }



    public function handleCallback(Request $request)
    {
        try {
            $notification = new Notification();
    
            $status = $notification->transaction_status;
            $orderId = $notification->order_id;
            $fraudStatus = $notification->fraud_status ?? null;
    
            $bookingId = str_replace('order_', '', $orderId);
            $booking = Booking::find($bookingId);
    
            if (!$booking) {
                return response()->json(['message' => 'Booking not found'], 404);
            }
    
            // Proses status pembayaran
            if ($status == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $booking->payment_status = 'failed';
                    $booking->booking_status = 'cancelled';
                } else {
                    $booking->payment_status = 'paid';
                    $booking->booking_status = 'complete';
                }
            } elseif ($status == 'settlement') {
                // Pembayaran berhasil (non kartu kredit)
                $booking->payment_status = 'paid';
                $booking->booking_status = 'complete';
            } elseif ($status == 'pending') {
                $booking->payment_status = 'pending';
                $booking->booking_status = 'ongoing';
            } elseif ($status == 'deny') {
                $booking->payment_status = 'failed';
                $booking->booking_status = 'cancelled';
            } elseif ($status == 'expire') {
                $booking->payment_status = 'expired';
                $booking->booking_status = 'cancelled';
            } elseif ($status == 'cancel') {
                $booking->payment_status = 'failed';
                $booking->booking_status = 'cancelled';
            }
    
            $booking->save();
    
            return response()->json(['message' => 'Callback processed successfully']);
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['message' => 'Callback failed'], 500);
        }
    }
    

}
