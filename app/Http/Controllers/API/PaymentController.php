<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
    }

    /**
     * Generate Snap token for payment.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function generateSnapToken(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'gross_amount' => 'required|numeric',
        ]);

        // Prepare transaction details
        $transactionDetails = [
            'order_id' => $request->order_id,
            'gross_amount' => $request->gross_amount, // Total price
        ];

        // Create an item list if necessary (optional)
        $itemDetails = [
            [
                'id' => $request->order_id,
                'price' => $request->gross_amount,
                'quantity' => 1,
                'name' => 'Rental Payment'
            ]
        ];

        // Prepare customer details (optional)
        $customerDetails = [
            'first_name' => 'Customer First Name',
            'last_name' => 'Customer Last Name',
            'email' => 'customer@example.com',
            'phone' => '08123456789',
        ];

        // Create the transaction object
        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            // Request Snap token from Midtrans
            $snapToken = Snap::getSnapToken($transaction);

            // Return the Snap token as a response
            return response()->json([
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Payment gateway error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
