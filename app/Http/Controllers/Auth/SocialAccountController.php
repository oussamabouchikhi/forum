<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Socialite;
use App\SocialAccountService; // Helper class

class SocialAccountController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     * @param $provider: it can be (facebook, github ...)
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     * @param $provider: it can be (facebook, github ...)
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(SocialAccountService $socialAccountService, $provider)
    {
        try {
            // get user data
            $user = Socialite::driver($provider)->user();

        } catch (\Exception $e) {
            // if there is an error (cannot get user data) redirect user to login page
            return redirect()->to('login');
        }

        // Authenticated user
        $authUser = $socialAccountService->findOrCreate($user, $provider);

        // login this user (true is for remembering the user)
        auth()->login($authUser, true);

        // redirect to home page after login
        return redirect()->to('home');

    }
}
