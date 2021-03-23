<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Str;
use Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function github()
    {
        // Send the user's request to github
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect()
    {
        // get oauth request back from github to authenticate user
        $user = Socialite::driver('github')->stateless()->user();

        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);

        return redirect('/dashboard');
    }
}
