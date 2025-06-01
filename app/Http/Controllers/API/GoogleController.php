<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
public function redirectToGoogle(Request $request)
{
    try {
        $platform = $request->get('platform', 'web');
        $redirectUri = url("api/login/google/callback?platform={$platform}");
        
        Log::info('Redirect URI:', ['uri' => $redirectUri]); 

        $url = Socialite::driver('google')
            ->stateless()
            ->with([
                'prompt' => 'select_account',
                'redirect_uri' => $redirectUri
            ])
            ->redirect()
            ->getTargetUrl();

        return redirect()->away($url);

    } catch (\Throwable $e) {
        Log::error('Google redirect error:', ['error' => $e->getMessage()]); 
        return response()->json([
            'status' => false,
            'message' => 'Gagal memulai login Google',
            'error' => $e->getMessage()
        ], 500);
    }
}



public function handleGoogleCallback(Request $request)
{
    try {
        $platform = $request->get('platform', 'web');
        
        Log::info('Google Callback Starting', [
            'platform' => $platform,
            'request_url' => $request->fullUrl(),
            'all_parameters' => $request->all()
        ]);

        $redirectUri = url("api/login/google/callback?platform={$platform}");
        
        Log::info('Using Redirect URI', ['uri' => $redirectUri]);

        $googleUser = Socialite::driver('google')
            ->stateless()
            ->redirectUrl($redirectUri)
            ->user();

        Log::info('Google User Retrieved', [
            'email' => $googleUser->getEmail(),
            'name' => $googleUser->getName()
        ]);

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => Hash::make(uniqid() . time()), 
                'phone' => '-',
                'role' => 'user',
                'email_verified_at' => now(), 
            ]
        );

        $user->tokens()->delete();

        $token = $user->createToken('google_auth_token')->plainTextToken;

        $responseData = [
            'status' => true,
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'no_telp' => $user->no_telp,
            
            ],
            'token' => $token,
        ];

        $jsonString = base64_encode(json_encode($responseData));

        Log::info('Auth Success - Preparing Redirect', [
            'platform' => $platform,
            'user_id' => $user->id
        ]);

        if ($platform === 'mobile') {
            $callbackUrl = "com.example.Rentkuy://callback?data={$jsonString}";
            Log::info('Redirecting to Mobile', ['url' => $callbackUrl]);
            return redirect()->away($callbackUrl);
        }

        $webRedirect = "http://localhost:5555/#/google-success?data={$jsonString}";
        Log::info('Redirecting to Web', ['url' => $webRedirect]);
        return redirect($webRedirect);

    } catch (\Throwable $e) {
        Log::error('Google Callback Failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        // Untuk mobile, redirect ke scheme dengan error
        if ($request->get('platform') === 'mobile') {
            $errorData = base64_encode(json_encode([
                'status' => false,
                'message' => 'Google authentication failed',
                'error' => $e->getMessage()
            ]));
            return redirect()->away("com.example.simi://callback?data={$errorData}");
        }

        return response()->json([
            'status' => false,
            'message' => 'Google callback failed',
            'error' => $e->getMessage()
        ], 500);
    }
}
} 
