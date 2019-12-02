<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\UserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\ClienteRepository;
use App\Repositories\Interfaces\ClienteRepositoryInterface;
use App\Repositories\InvoiceDetailRepository;
use App\Repositories\Interfaces\InvoiceDetailRepositoryInterface;
use App\Repositories\InvoiceRepository;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\EmpresaRepository;
use App\Repositories\Interfaces\EmpresaRepositoryInterface;
use App\Repositories\UbigeoRepository;
use App\Repositories\Interfaces\UbigeoRepositoryInterface;
use App\Repositories\PersonaRepository;
use App\Repositories\Interfaces\PersonaRepositoryInterface;
use App\Repositories\GastoRepository;
use App\Repositories\Interfaces\GastoRepositoryInterface;
use App\Repositories\GastoDetailRepository;
use App\Repositories\Interfaces\GastoDetailRepositoryInterface;
use App\Repositories\ResponsableRepository;
use App\Repositories\Interfaces\ResponsableRepositoryInterface;
use App\Repositories\PagoRepository;
use App\Repositories\Interfaces\PagoRepositoryInterface;
use App\Repositories\PresupuestoRepository;
use App\Repositories\Interfaces\PresupuestoRepositoryInterface;
use App\Repositories\ConceptoRepository;
use App\Repositories\Interfaces\ConceptoRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( UserRepositoryInterface::class, UserRepository::class );
        $this->app->bind( ClienteRepositoryInterface::class, ClienteRepository::class );
        $this->app->bind( InvoiceDetailRepositoryInterface::class, InvoiceDetailRepository::class );
        $this->app->bind( InvoiceRepositoryInterface::class, InvoiceRepository::class );
        $this->app->bind( EmpresaRepositoryInterface::class, EmpresaRepository::class );
        $this->app->bind( UbigeoRepositoryInterface::class, UbigeoRepository::class );
        $this->app->bind( PersonaRepositoryInterface::class, PersonaRepository::class );
        $this->app->bind( GastoRepositoryInterface::class, GastoRepository::class );
        $this->app->bind( GastoDetailRepositoryInterface::class, GastoDetailRepository::class );
        $this->app->bind( ResponsableRepositoryInterface::class, ResponsableRepository::class );
        $this->app->bind( PagoRepositoryInterface::class, PagoRepository::class );
        $this->app->bind( PresupuestoRepositoryInterface::class, PresupuestoRepository::class );
        $this->app->bind( ConceptoRepositoryInterface::class, ConceptoRepository::class );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
