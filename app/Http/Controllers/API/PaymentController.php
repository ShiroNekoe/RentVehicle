<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        // Kirim balik data request sebagai debug
        $debugInfo = ['request' => $request->all()];

        $validator = Validator::make($request->all(), [
            'id_booking' => 'required|integer|exists:bookings,id',
            'payment_price' => 'required|numeric',
            'payment_method' => 'required|string',
            'transfer_to' => 'nullable|string',
            'proof' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
                'debug' => $debugInfo,
            ], 422);
        }

        try {
            $proofPath = null;
            if ($request->hasFile('proof')) {
                $file = $request->file('proof');
                $proofPath = $file->store('proofs', 'public');
                $debugInfo['file_stored_path'] = $proofPath;
            } else {
                $debugInfo['file_stored_path'] = 'Tidak ada file proof yang diupload';
            }

            $payment = Payment::create([
                'id_booking' => $request->id_booking,
                'payment_price' => $request->payment_price,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'payment_date' => now(),
                'transfer_to' => $request->transfer_to,
                'proof' => $proofPath,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Pembayaran dibuat, status pending',
                'data' => $payment,
                'debug' => $debugInfo,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage(),
                'debug' => $debugInfo,
            ], 500);
        }
    }
}
