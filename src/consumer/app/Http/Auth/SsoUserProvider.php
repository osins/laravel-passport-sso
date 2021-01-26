<?php
namespace App\Http\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\OAuth2\User;

class SsoUserProvider implements UserProvider
{
    private $token;
    private $user;

    public function __construct()
    {
        $token = \request()->bearerToken();
        if (!is_null($token)) {
            $user = $this->getDriver()->userFromToken($token);
        }
    }

    private function getConfig()
    {
        $clientId = env('LARAVELPASSPORT_CLIENT_ID');
        $clientSecret = env('LARAVELPASSPORT_CLIENT_SECRET');
        $redirectUrl = env('LARAVELPASSPORT_REDIRECT_URI');
        $additionalProviderConfig = ['host' => env('LARAVELPASSPORT_SSO_URI')];

        $config = new \SocialiteProviders\Manager\Config(
            $clientId,
            $clientSecret,
            $redirectUrl,
            $additionalProviderConfig
        );
        return $config;
    }

    private function getDriver()
    {
        return Socialite::driver('laravelpassport')->setConfig($this->getConfig());
    }

    public function retrieveById($identifier)
    {
        return $this->user;
    }

    public function retrieveByToken($identifier, $token)
    {
        if (is_null($token)) {
            return null;
        }

        $ssoUser = $this->getDriver()->userFromToken($token);
        if (is_null($ssoUser)) {
            return null;
        }

        if (is_null($ssoUser->getId())) {
            return null;
        }

        return new \App\Http\Auth\SsoUser($ssoUser);
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // update via remember token not necessary
    }

    public function retrieveByCredentials(array $credentials)
    {
        return $this->user;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return !is_null($this->user);
    }
}
