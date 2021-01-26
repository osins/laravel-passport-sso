<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('sso_provider', function ($app, array $config) {
            return new \App\Http\Auth\SsoUserProvider();
        });

        Auth::extend('access_token', function ($app, $name, array $config) {
            // automatically build the DI, put it as reference
            $provider = app(\App\Http\Auth\SsoUserProvider::class);
            $request = app('request');
            // dd($app, $name, $config, $provider);
            return new \App\Http\Auth\SsoGuard($provider, $request, $config);
        });
    }
}
