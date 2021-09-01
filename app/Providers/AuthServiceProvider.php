<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * we call the passport: routes
     * to register routes that our application will use * to issue tokens and clients
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // call passport:routes() here
        if (!$this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
