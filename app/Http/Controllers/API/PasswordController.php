<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordController extends Controller
{
    public function sendOtp(Request $request)
    {
        // Validasi input
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Buat OTP 4 digit
        $otp = rand(1000, 9999);

        try {
            // Update atau Insert OTP ke database
            DB::table('users')->updateOrInsert(
                ['email' => $request->email],
                ['otp' => $otp, 'created_at' => Carbon::now()]
            );

            // Kirim OTP melalui email
            Mail::raw("Kode OTP reset password anda: $otp", function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Reset Password OTP');
            });

            // Respons sukses
            return response()->json([
                'status' => true,
                'message' => 'OTP sent to email'
            ]);

        } catch (\Exception $e) {
            // Tangani error pengiriman email atau DB
            return response()->json([
                'status' => false,
                'message' => 'Failed to send OTP: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:4' // Sesuaikan dengan panjang OTP yang Anda buat
        ]);

        // Cek OTP di database
        $record = DB::table('users')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$record) {
            // OTP tidak valid
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 400);
        }

        // OTP berhasil diverifikasi
        return response()->json([
            'status' => true,
            'message' => 'OTP Verified'
        ]);
    }
 public function resetPassword(Request $request)
    {
        Log::info('Reset Password Request:', $request->all());  // Log request yang diterima

        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:4',
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Cek OTP di database
        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        // Jika tidak ditemukan user atau OTP tidak valid
        if (!$user) {
            Log::error('Invalid OTP for email: ' . $request->email); // Log error
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 400);  // Kode status 400 menunjukkan bad request
        }

        // Update password pengguna
        try {
            $user->password = Hash::make($request->password);
            $user->save();  // Simpan password yang baru

            // Hapus OTP setelah berhasil reset password
            $user->otp = null;
            $user->save();  // Simpan perubahan OTP menjadi null

            // Respons sukses
            return response()->json([
                'status' => true,
                'message' => 'Password has been reset'
            ]);
        } catch (\Exception $e) {
            Log::error('Error during password reset: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error during password reset: ' . $e->getMessage()
            ], 500); // Kode status 500 untuk server error
        }
    }
}


