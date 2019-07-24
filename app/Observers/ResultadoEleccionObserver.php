<?php

namespace App\Observers;

use App\ResultadoEleccion;
use Illuminate\Support\Facades\Auth;

class ResultadoEleccionObserver
{
    public function saving(ResultadoEleccion $resultadoEleccion)
    {
        
    }
    /**
     * Handle the ResultadoEleccion "created" event.
     *
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return void
     */
    public function creating(ResultadoEleccion $resultadoEleccion)
    {
        $resultadoEleccion->created_by = Auth::id();
        $resultadoEleccion->updated_by = Auth::id();
    }

    /**
     * Handle the ResultadoEleccion "updated" event.
     *
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return void
     */
    public function updating(ResultadoEleccion $resultadoEleccion)
    {
        $resultadoEleccion->updated_by = Auth::id();
    }
    /**
     * Handle the ResultadoEleccion "deleted" event.
     *
     * @param  \App\ResultadoEleccion  $translado
     * @return void
     */
    public function deleting(ResultadoEleccion $resultadoEleccion)
    {
        $resultadoEleccion->deleted_by = Auth::id();
    }
    /**
     * Handle the proceso disciplinario "created" event.
     *
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return void
     */
    public function created(ResultadoEleccion $resultadoEleccion)
    {

    }

    /**
     * Handle the proceso disciplinario "updated" event.
     *
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return void
     */
    public function updated(ResultadoEleccion $resultadoEleccion)
    {

    }

    /**
     * Handle the proceso disciplinario "deleted" event.
     *
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return void
     */
    public function deleted(ResultadoEleccion $resultadoEleccion)
    {

    }

    /**
     * Handle the proceso disciplinario "restored" event.
     *
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return void
     */
    public function restored(ResultadoEleccion $resultadoEleccion)
    {
        //
    }

    /**
     * Handle the proceso disciplinario "force deleted" event.
     *
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return void
     */
    public function forceDeleted(ResultadoEleccion $resultadoEleccion)
    {
        //
    }
}
