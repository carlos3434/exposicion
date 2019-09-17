<?php

namespace App\Observers;

use App\Cliente;
use Illuminate\Support\Facades\Auth;

class ClienteObserver
{
    public function saving(Cliente $cliente)
    {
        
    }
    /**
     * Handle the Cliente "created" event.
     *
     * @param  \App\Cliente  $cliente
     * @return void
     */
    public function creating(Cliente $cliente)
    {
        $cliente->created_by = Auth::id();
        $cliente->updated_by = Auth::id();
    }

    /**
     * Handle the Cliente "updated" event.
     *
     * @param  \App\Cliente  $cliente
     * @return void
     */
    public function updating(Cliente $cliente)
    {
        $cliente->updated_by = Auth::id();
    }
    /**
     * Handle the Cliente "deleted" event.
     *
     * @param  \App\Cliente  $translado
     * @return void
     */
    public function deleting(Cliente $cliente)
    {
        $cliente->deleted_by = Auth::id();
    }
    /**
     * Handle the proceso disciplinario "created" event.
     *
     * @param  \App\Cliente  $cliente
     * @return void
     */
    public function created(Cliente $cliente)
    {

    }

    /**
     * Handle the proceso disciplinario "updated" event.
     *
     * @param  \App\Cliente  $cliente
     * @return void
     */
    public function updated(Cliente $cliente)
    {

    }

    /**
     * Handle the proceso disciplinario "deleted" event.
     *
     * @param  \App\Cliente  $cliente
     * @return void
     */
    public function deleted(Cliente $cliente)
    {

    }

    /**
     * Handle the proceso disciplinario "restored" event.
     *
     * @param  \App\Cliente  $cliente
     * @return void
     */
    public function restored(Cliente $cliente)
    {
        //
    }

    /**
     * Handle the proceso disciplinario "force deleted" event.
     *
     * @param  \App\Cliente  $cliente
     * @return void
     */
    public function forceDeleted(Cliente $cliente)
    {
        //
    }
}
