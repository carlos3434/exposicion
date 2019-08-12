<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Incidente;
use App\Translado;
use App\Licencia;
use App\ProcesoDisciplinario;
use App\Apelacion;
use App\Comite;
use App\ResultadoEleccion;
use App\ListaGanadora;
use App\ListaPostulante;
use App\Persona;

use App\Observers\IncidenteObserver;
use App\Observers\TransladoObserver;
use App\Observers\LicenciaObserver;
use App\Observers\ProcesoDisciplinarioObserver;
use App\Observers\ApelacionObserver;
use App\Observers\ComiteObserver;
use App\Observers\ResultadoEleccionObserver;
use App\Observers\ListaGanadoraObserver;
use App\Observers\ListaPostulanteObserver;
use App\Observers\PersonaObserver;

use Illuminate\Support\Facades\Validator;

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
        ProcesoDisciplinario::observe(ProcesoDisciplinarioObserver::class);
        Apelacion::observe(ApelacionObserver::class);
        Comite::observe(ComiteObserver::class);
        ResultadoEleccion::observe(ResultadoEleccionObserver::class);
        ListaGanadora::observe(ListaGanadoraObserver::class);
        ListaPostulante::observe(ListaPostulanteObserver::class);
        Persona::observe(PersonaObserver::class);

        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value); 
        });
        Validator::extend('alpha_num_spaces', function ($attribute, $value) {
            return preg_match('/^([-a-z0-9_ ])+$/i', $value);
        });
        Schema::defaultStringLength(191);
    }
}
