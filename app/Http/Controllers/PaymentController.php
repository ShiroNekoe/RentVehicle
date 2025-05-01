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
                'price' => $booking->total_price,
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
    // Ambil data dari Midtrans notification
    $notification = new Notification();

    // Tentukan status pembayaran
    $status = $notification->transaction_status;
    $orderId = $notification->order_id;
    $fraudStatus = $notification->fraud_status;

    // Cari booking berdasarkan order_id
    $booking = Booking::where('id', str_replace('order_', '', $orderId))->first();

    // Proses status pembayaran
    if ($status == 'capture') {
        if ($fraudStatus == 'challenge') {
            // Pembayaran gagal karena fraud
            $booking->status = 'failed';
        } else {
            // Pembayaran berhasil
            $booking->status = 'success';
        }
    } elseif ($status == 'pending') {
        // Pembayaran tertunda
        $booking->status = 'pending';
    } elseif ($status == 'cancel') {
        // Pembayaran dibatalkan
        $booking->status = 'failed';
    }

    // Simpan status transaksi
    $booking->save();

    return response()->json(['message' => 'Callback received successfully']);
}

}
