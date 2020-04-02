<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
       /** Retrieving User Details */
        
        // get user info from provider
        $account = SocialAccount::where('provider_id', $providerUser->getId())->where('provider_name', $provider)->first();

        // check if user account exist in our database
        if ($account) {
            
            return $account->user;

        } else { // There's no user with this account info
            # because a user can register normally
            # check if there is a user by its email
            $user = User::where('email', $providerUser->getEmail())->first(); // get a user by email
            if (!$user) { // if this user does not exist
                
                // Create user
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name'  => $providerUser->getName()
                ]);
            }

            // if this user exist bind this user account info with this user
            $user->accounts()->create([
                'provider_name' => $provider,
                'provider_id'   => $providerUser->getId()
            ]);

            return $user;

        }
    }
}
