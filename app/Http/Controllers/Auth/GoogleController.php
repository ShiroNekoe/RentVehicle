<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'email_verified_at' => now(),
                'password' => bcrypt(uniqid()), // password acak
            ]);

            Auth::login($user);

            return redirect()->intended('/dashboard');
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors(['google' => 'Gagal login dengan Google.']);
        }
    }
}
