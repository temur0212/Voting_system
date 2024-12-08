<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect to Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

            if ($findUser) {
                // If user exists, log them in
                Auth::login($findUser);
            } else {
                // Create new user
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('dummy-password'), // Dummy password
                ]);

                $newUser->assignRole('user');

                Auth::login($newUser);
            }

            return redirect()->route('index')->with('success', 'Tizimga Muaffaqqiyatli kirdingiz!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to login with Google.');
        }
    }
}
