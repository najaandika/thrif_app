<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotification;

class AuthGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        try {
            // Use stateless() to avoid session state issues with php artisan serve
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            // If stateless fails, redirect back to login with error
            return redirect()->route('login')->with('error', 'Google login failed. Please try again.');
        }

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(uniqid()),
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user, true);

        // Kirim email notifikasi login
        Mail::to($user->email)->send(new LoginNotification($user));

        return redirect('/');
    }
}
