<?php
namespace App\Http\Auth;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class SsoGuard implements Guard
{
    use GuardHelpers;
    private $request;

    public function __construct(UserProvider $provider, Request $request, $configuration)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        $token = $this->request->bearerToken();
        $this->user = $this->provider->retrieveByToken(null, $token);

        return !is_null($this->user);
    }

    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $user = $this->provider->retrieveByToken(null, $token);

        return $this->user = $user;
    }

    /**
     * Get the token for the current request.
     * @return string
     */
    public function getTokenForRequest()
    {
        $token = $this->request->bearerToken();

        return $token;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array $credentials
     *
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        $token = $this->request->bearerToken();
        $this->user = $this->provider->retrieveByToken(null, $token);

        return !is_null($this->user);
    }
}
