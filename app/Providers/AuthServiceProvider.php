<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        //addMinutes , addWeeks , addDays , addYears
        //login de api passport
        Passport::personalAccessTokensExpireIn(Carbon::now()->addYears(1));

        //Passport::tokensExpireIn( Carbon::now()->addMinutes(30) );

        //Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(1));

    }
}
