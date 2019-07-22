<?php

namespace App\Observers;

use App\ProcesoDisciplinario;
use Illuminate\Support\Facades\Auth;

class ProcesoDisciplinarioObserver
{
    /**
     * Handle the ProcesoDisciplinario "created" event.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return void
     */
    public function creating(ProcesoDisciplinario $procesoDisciplinario)
    {
        $procesoDisciplinario->created_by = Auth::id();
        $procesoDisciplinario->updated_by = Auth::id();
    }

    /**
     * Handle the ProcesoDisciplinario "updated" event.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return void
     */
    public function updating(ProcesoDisciplinario $procesoDisciplinario)
    {
        $procesoDisciplinario->updated_by = Auth::id();
    }
    /**
     * Handle the ProcesoDisciplinario "deleted" event.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return void
     */
    public function deleting(ProcesoDisciplinario $procesoDisciplinario)
    {
        $procesoDisciplinario->deleted_by = Auth::id();
    }
    /**
     * Handle the proceso disciplinario "created" event.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return void
     */
    public function created(ProcesoDisciplinario $procesoDisciplinario)
    {
        $procesoDisciplinario->created_by = Auth::id();
        $procesoDisciplinario->updated_by = Auth::id();
    }

    /**
     * Handle the proceso disciplinario "updated" event.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return void
     */
    public function updated(ProcesoDisciplinario $procesoDisciplinario)
    {
        $procesoDisciplinario->updated_by = Auth::id();
    }

    /**
     * Handle the proceso disciplinario "deleted" event.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return void
     */
    public function deleted(ProcesoDisciplinario $procesoDisciplinario)
    {
        $procesoDisciplinario->deleted_by = Auth::id();
    }

    /**
     * Handle the proceso disciplinario "restored" event.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return void
     */
    public function restored(ProcesoDisciplinario $procesoDisciplinario)
    {
        //
    }

    /**
     * Handle the proceso disciplinario "force deleted" event.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return void
     */
    public function forceDeleted(ProcesoDisciplinario $procesoDisciplinario)
    {
        //
    }
}
