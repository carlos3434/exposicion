<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\UserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\ClienteRepository;
use App\Repositories\Interfaces\ClienteRepositoryInterface;
use App\Repositories\InvoiceDetailRepository;
use App\Repositories\Interfaces\InvoiceDetailRepositoryInterface;

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
