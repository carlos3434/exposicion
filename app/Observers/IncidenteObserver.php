<?php

namespace App\Observers;

use App\Incidente;
use Illuminate\Support\Facades\Auth;

class IncidenteObserver
{
    public function saving(Incidente $incidente)
    {
        
    }
    /**
     * Handle the incidente "created" event.
     *
     * @param  \App\Incidente  $incidente
     * @return void
     */
    public function creating(Incidente $incidente)
    {
        $incidente->created_by = Auth::id();
        $incidente->updated_by = Auth::id();
    }

    /**
     * Handle the incidente "updated" event.
     *
     * @param  \App\Incidente  $incidente
     * @return void
     */
    public function updating(Incidente $incidente)
    {
        $incidente->updated_by = Auth::id();
    }

    /**
     * Handle the incidente "deleted" event.
     *
     * @param  \App\Incidente  $incidente
     * @return void
     */
    public function deleting(Incidente $incidente)
    {
        $incidente->deleted_by = Auth::id();
    }

    /**
     * Handle the incidente "restored" event.
     *
     * @param  \App\Incidente  $incidente
     * @return void
     */
    public function restored(Incidente $incidente)
    {
        //
    }

    /**
     * Handle the incidente "force deleted" event.
     *
     * @param  \App\Incidente  $incidente
     * @return void
     */
    public function forceDeleted(Incidente $incidente)
    {
        //
    }
}
