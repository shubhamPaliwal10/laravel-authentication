<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // User already exists
                Auth::login($user);
            } else {
                // Create a new user
                $user = User::create([
                    'first_name' => $googleUser->user['given_name'],
                    'last_name' => $googleUser->user['family_name'],
                    'email' => $googleUser->email,
                    'password' => Hash::make('random-password'),
                    'remember_token' => $googleUser->token,
                ]);

                Auth::login($user);
            }

            return redirect()->intended('dashboard');
        // } catch (Exception $e) {
        //     return redirect()->route('login')->with('error', 'Unable to login using Google. Please try again.');
        // }
    }
}
