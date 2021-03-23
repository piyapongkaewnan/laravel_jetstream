<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;

class LoginController extends Controller
{

    public function redirectToProvider($provider = 'google')
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider = 'google')
    {
        $providerUser = Socialite::driver($provider)->user();

        $this->firstOrCreateUser($providerUser);

        return redirect()->to('/dashboard');
    }


    // // Google oauth
    // public function google()
    // {
    //     // Send the user's request to google
    //     return Socialite::driver('google')->redirect();
    // }

    // public function googleRedirect()
    // {
    //     // get oauth request back from google to authenticate user
    //     $user = Socialite::driver('google')->user();

    //     $this->firstOrCreateUser($user);

    //     return redirect('/dashboard');
    // }


    // // Facebook oauth
    // public function facebook()
    // {
    //     // Send the user's request to facebook
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function facebookRedirect()
    // {
    //     // get oauth request back from github to authenticate user
    //     $user = Socialite::driver('facebook')->user();

    //     $this->firstOrCreateUser($user);

    //     return redirect('/dashboard');
    // }

    // // Github oauth
    // public function github()
    // {
    //     // Send the user's request to github
    //     return Socialite::driver('github')->redirect();
    // }

    // public function githubRedirect()
    // {
    //     // get oauth request back from github to authenticate user
    //     $user = Socialite::driver('github')->user();

    //     $this->firstOrCreateUser($user);

    //     return redirect('/dashboard');
    // }

    private function firstOrCreateUser($user)
    {
        $user = User::firstOrCreate(
            [
                'email' => $user->email
            ],
            [
                'name' => $user->name,
                'password' => bcrypt(Str::random(24))
            ]
        );

        Auth::login($user, true);
    }
}
