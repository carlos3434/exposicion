<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Incidente;
use App\Translado;
use App\Licencia;

use App\Observers\IncidenteObserver;
use App\Observers\TransladoObserver;
use App\Observers\LicenciaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Incidente::observe(IncidenteObserver::class);
        Translado::observe(TransladoObserver::class);
        Licencia::observe(LicenciaObserver::class);
        Schema::defaultStringLength(191);
    }
}
