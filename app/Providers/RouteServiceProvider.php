<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
        Route::model('user', \App\User::class);
        Route::model('permission', \Caffeinated\Shinobi\Models\Permission::class);
        Route::model('role', \Caffeinated\Shinobi\Models\Role::class);

        Route::model('diploma', \App\EntregaDiploma::class);
        Route::model('incidente', \App\Incidente::class);
        Route::model('translado', \App\Translado::class);
        Route::model('licencia', \App\Licencia::class);
        Route::model('proceso', \App\ProcesoDisciplinario::class);
        Route::model('apelacione', \App\Apelacion::class);
        Route::model('comite', \App\Comite::class);
        Route::model('listasGanadora', \App\ListaGanadora::class);
        Route::model('listaPostulante', \App\ListaPostulante::class);
        Route::model('resultadoEleccione', \App\ResultadoEleccion::class);
        Route::model('persona', \App\Persona::class);
        Route::model('gasto', \App\Gasto::class);

        Route::model('cliente', \App\Cliente::class);
        Route::model('empresa', \App\Empresa::class);
        Route::model('invoice', \App\Invoice::class);
        Route::model('serie', \App\Serie::class);


    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
