<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class SsoController extends Controller
{
    public function redirect()
    {
        $clientId = env('LARAVELPASSPORT_CLIENT_ID');
        $clientSecret = env('LARAVELPASSPORT_CLIENT_SECRET');
        $redirectUrl = env('LARAVELPASSPORT_REDIRECT_URI');
        $additionalProviderConfig = ['host' => 'http://sso:8080'];
        $config = new \SocialiteProviders\Manager\Config($clientId, $clientSecret, $redirectUrl,
            $additionalProviderConfig);

        return Socialite::driver('laravelpassport')->setConfig($config)->redirect();
    }

    public function callback()
    {
        $clientId = env('LARAVELPASSPORT_CLIENT_ID');
        $clientSecret = env('LARAVELPASSPORT_CLIENT_SECRET');
        $redirectUrl = env('LARAVELPASSPORT_REDIRECT_URI');
        $additionalProviderConfig = ['host' => 'http://sso:8080'];
        $config = new \SocialiteProviders\Manager\Config($clientId, $clientSecret, $redirectUrl,
            $additionalProviderConfig);
        // dd(urldecode(\request('code')));
        $user = Socialite::driver('laravelpassport')->setConfig($config)->user();
        return compact('user');
    }

    public function getUser()
    {
        $clientId = env('LARAVELPASSPORT_CLIENT_ID');
        $clientSecret = env('LARAVELPASSPORT_CLIENT_SECRET');
        $redirectUrl = env('LARAVELPASSPORT_REDIRECT_URI');
        $additionalProviderConfig = ['host' => 'http://sso:8080'];
        $config = new \SocialiteProviders\Manager\Config($clientId, $clientSecret, $redirectUrl,
            $additionalProviderConfig);

        $user = Socialite::driver('laravelpassport')->setConfig($config)->userFromToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjBjMmZkODE4NjdjYTg0OTY3MTIyMThhNzUyZjM0ODMzYzI3NDU5OWFkOWRhZDhmOGFkZmIzY2Y2N2EzNjNjOGNjZjY3ZDVkZGFhNGQ4ZDgiLCJpYXQiOjE2MTE1MTIwNjQsIm5iZiI6MTYxMTUxMjA2NCwiZXhwIjoxNjQzMDQ4MDY0LCJzdWIiOiI3Iiwic2NvcGVzIjpbXX0.LsSpM1-QFLrG9jlO-VErzKQcbzDwBVMNC0H32HSUDeNjMAHoJt83p4lFkN1ZViqijgg63Ut5DyWF04iEj0hRTIggkAcLWahDWJIUW9l7ixV9l2cc_g26vDmtiM5fXq4LLvurZAwlKV48qwdTE6hkNwCM7oY0cwd_vTd-WYtEbXHlCKySj0PF9p3JmsDyEIYhcmTf2or5Ugqx-aRtdlxtQLwj7PjUcPgwjyafA_WcxoX9Mc4D-xsRCHxg6ymGO02iUSVCxbi-Le03t04wsCRCA2uuv1NzahgS2r_YhRqHQISGnYuEnvCyBhdraDp5fG2Z05TRbfPEovPWOxzuWU87Znw7TgrypNBghEeNeESoTp61DcWt8vpaczm8LZ0J_h8a-u-sO9omYfyLejZsGA0PpWsi_hbwyBU91At7YXmNQ8HniqqVire6xMMiyOFFxJtQowSzPUI7LtPgs9JwloGAzoOnuNd9qDhXRAwhWB-BuVBZXGfJmSWEceKh806PeALJd5Ho5Qhewvq9CA9_n5TArrOFJYcXALwNj6dao-sx9lDsQBRXyfpMX4N6UD-tXOrhfi5BklZzPX178XKQ3u3qtPX879WF91hqyL5julT8YMKi5uNRir8CmOu383il0z-ln68iUt2F-jhVWkZP6TlbWYQgo_jNpZbHFiuWLWFbebE');
        return compact('user');
    }
}
