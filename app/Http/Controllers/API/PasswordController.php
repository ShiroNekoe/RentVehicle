<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PasswordController extends Controller
{
    public function sendOtp(Request $request)
    {
        Log::info('sendOtp called', ['email' => $request->email ?? 'no email']);

        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(1000, 9999);
        Log::info('Generated OTP', ['otp' => $otp]);

        try {
            DB::table('users')->updateOrInsert(
                ['email' => $request->email],
                ['otp' => $otp, 'created_at' => Carbon::now()]
            );
            Log::info('OTP saved to DB', ['email' => $request->email, 'otp' => $otp]);

            Mail::raw("Kode OTP reset password anda: $otp", function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Reset Password OTP');
            });

            Log::info('OTP email sent', ['email' => $request->email]);

            return response()->json([
                'status' => true,
                'message' => 'OTP sent to email'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send OTP', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Failed to send OTP: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        Log::info('verifyOtp called', ['email' => $request->email ?? 'no email', 'otp' => $request->otp ?? 'no otp']);

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:4'
        ]);

        $record = DB::table('users')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$record) {
            Log::warning('Invalid OTP attempt', ['email' => $request->email, 'otp' => $request->otp]);
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 400);
        }

        Log::info('OTP verified successfully', ['email' => $request->email]);
        return response()->json([
            'status' => true,
            'message' => 'OTP Verified'
        ]);
    }

    public function resetPassword(Request $request)
    {
        Log::info('resetPassword called', $request->all());

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:4',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$user) {
            Log::error('Invalid OTP during reset password', ['email' => $request->email, 'otp' => $request->otp]);
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 400);
        }

        try {
            $user->password = Hash::make($request->password);
            $user->save();

            $user->otp = null;
            $user->save();

            Log::info('Password reset successful', ['email' => $request->email]);

            return response()->json([
                'status' => true,
                'message' => 'Password has been reset'
            ]);
        } catch (\Exception $e) {
            Log::error('Error during password reset', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Error during password reset: ' . $e->getMessage()
            ], 500);
        }
    }
}
