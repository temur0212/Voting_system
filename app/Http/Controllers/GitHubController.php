<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{
    /**
     * Redirect to GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Handle GitHub callback.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGitHubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            $findUser = User::Where('email', $githubUser->email)
                ->first();

            if ($findUser) {
                // If user exists, log them in
                Auth::login($findUser);
            } else {
                // Create new user
                $newUser = User::create([
                    'name' => $githubUser->name ?? $githubUser->nickname,
                    'email' => $githubUser->email,
                    'github_id' => $githubUser->id,
                    'password' => bcrypt('dummy_password'), // Dummy password
                ]);

                // Assign default role (optional)
                $newUser->assignRole('user'); // Requires spatie/laravel-permission

                Auth::login($newUser);
            }

            return redirect()->route('index')->with('success', 'Tizimga Muaffaqqiyatli kirdingiz!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to login with GitHub.');
        }
    }
}
