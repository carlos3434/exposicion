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
