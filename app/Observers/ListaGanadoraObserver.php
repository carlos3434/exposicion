<?php

namespace App\Observers;

use App\ListaGanadora;
use Illuminate\Support\Facades\Auth;

class ListaGanadoraObserver
{
    public function saving(ListaGanadora $listaGanadora)
    {
        
    }
    /**
     * Handle the ListaGanadora "created" event.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return void
     */
    public function creating(ListaGanadora $listaGanadora)
    {
        $listaGanadora->created_by = Auth::id();
        $listaGanadora->updated_by = Auth::id();
    }

    /**
     * Handle the ListaGanadora "updated" event.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return void
     */
    public function updating(ListaGanadora $listaGanadora)
    {
        $listaGanadora->updated_by = Auth::id();
    }
    /**
     * Handle the ListaGanadora "deleted" event.
     *
     * @param  \App\ListaGanadora  $translado
     * @return void
     */
    public function deleting(ListaGanadora $listaGanadora)
    {
        $listaGanadora->deleted_by = Auth::id();
    }
    /**
     * Handle the proceso disciplinario "created" event.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return void
     */
    public function created(ListaGanadora $listaGanadora)
    {

    }

    /**
     * Handle the proceso disciplinario "updated" event.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return void
     */
    public function updated(ListaGanadora $listaGanadora)
    {

    }

    /**
     * Handle the proceso disciplinario "deleted" event.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return void
     */
    public function deleted(ListaGanadora $listaGanadora)
    {

    }

    /**
     * Handle the proceso disciplinario "restored" event.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return void
     */
    public function restored(ListaGanadora $listaGanadora)
    {
        //
    }

    /**
     * Handle the proceso disciplinario "force deleted" event.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return void
     */
    public function forceDeleted(ListaGanadora $listaGanadora)
    {
        //
    }
}
