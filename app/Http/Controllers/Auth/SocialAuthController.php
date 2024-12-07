<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialAuthController extends Controller
{
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback() {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::firstOrCreate(
                ['google_id' => $googleUser->getId()],
                [
                    'first_name' => $googleUser->user['given_name'],
                    'last_name' => $googleUser->user['family_name'],
                    'mobile' => '',
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(8)),
                ]
            );

            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to login using Google. Please try again.');
        }
    }
}
