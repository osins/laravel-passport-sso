<?php

namespace App\Http\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use SocialiteProviders\Manager\OAuth2\User;

class SsoUser implements Authenticatable
{
    protected $user;

    public function __construct(User $user)
    {
        $token = \request()->bearerToken();
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getAuthIdentifierName()
    {
        $this->user->id;
    }

    /**
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        $this->user->id;
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getRememberToken()
    {
        // Return the token used for the "remember me" functionality
    }

    /**
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // Store a new token user for the "remember me" functionality
    }

    /**
     * @return string
     */
    public function getRememberTokenName()
    {
        // Return the name of the column / attribute used to store the "remember me" token
    }
}
