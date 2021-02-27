<?php
namespace App\Services;
use App\SocialGoogleAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Illuminate\Support\Facades\Hash;

class SocialGoogleAccountService
{
    public function createOrGetUser(ProviderUser $providerUser){
        $user = User::where('email', '=', $providerUser->getEmail())->first();

        if (empty($user)) {
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'password' => Hash::make(md5(rand(1,10000))),
            ]);
        }
        return $user;
    }
}