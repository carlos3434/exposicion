<?php

namespace App\Observers;

use App\ListaPostulante;
use Illuminate\Support\Facades\Auth;

class ListaPostulanteObserver
{
    public function saving(ListaPostulante $listaPostulante)
    {
        
    }
    /**
     * Handle the ListaPostulante "created" event.
     *
     * @param  \App\ListaPostulante  $listaPostulante
     * @return void
     */
    public function creating(ListaPostulante $listaPostulante)
    {
        $listaPostulante->created_by = Auth::id();
        $listaPostulante->updated_by = Auth::id();
    }

    /**
     * Handle the ListaPostulante "updated" event.
     *
     * @param  \App\ListaPostulante  $listaPostulante
     * @return void
     */
    public function updating(ListaPostulante $listaPostulante)
    {
        $listaPostulante->updated_by = Auth::id();
    }
    /**
     * Handle the ListaPostulante "deleted" event.
     *
     * @param  \App\ListaPostulante  $translado
     * @return void
     */
    public function deleting(ListaPostulante $listaPostulante)
    {
        $listaPostulante->deleted_by = Auth::id();
    }
    /**
     * Handle the proceso disciplinario "created" event.
     *
     * @param  \App\ListaPostulante  $listaPostulante
     * @return void
     */
    public function created(ListaPostulante $listaPostulante)
    {

    }

    /**
     * Handle the proceso disciplinario "updated" event.
     *
     * @param  \App\ListaPostulante  $listaPostulante
     * @return void
     */
    public function updated(ListaPostulante $listaPostulante)
    {

    }

    /**
     * Handle the proceso disciplinario "deleted" event.
     *
     * @param  \App\ListaPostulante  $listaPostulante
     * @return void
     */
    public function deleted(ListaPostulante $listaPostulante)
    {

    }

    /**
     * Handle the proceso disciplinario "restored" event.
     *
     * @param  \App\ListaPostulante  $listaPostulante
     * @return void
     */
    public function restored(ListaPostulante $listaPostulante)
    {
        //
    }

    /**
     * Handle the proceso disciplinario "force deleted" event.
     *
     * @param  \App\ListaPostulante  $listaPostulante
     * @return void
     */
    public function forceDeleted(ListaPostulante $listaPostulante)
    {
        //
    }
}
