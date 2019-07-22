<?php

namespace App\Observers;

use App\Licencia;
use Illuminate\Support\Facades\Auth;

class LicenciaObserver
{
    public function saving(Licencia $licencia)
    {
        
    }
    /**
     * Handle the Licencia "created" event.
     *
     * @param  \App\Licencia  $licencia
     * @return void
     */
    public function creating(Licencia $licencia)
    {
        $licencia->created_by = Auth::id();
        $licencia->updated_by = Auth::id();
    }

    /**
     * Handle the Licencia "updated" event.
     *
     * @param  \App\Licencia  $licencia
     * @return void
     */
    public function updating(Licencia $licencia)
    {
        $licencia->updated_by = Auth::id();
    }

    /**
     * Handle the Licencia "deleted" event.
     *
     * @param  \App\Licencia  $licencia
     * @return void
     */
    public function deleting(Licencia $licencia)
    {
        $licencia->deleted_by = Auth::id();
    }

    /**
     * Handle the Licencia "restored" event.
     *
     * @param  \App\Licencia  $licencia
     * @return void
     */
    public function restored(Licencia $licencia)
    {
        //
    }

    /**
     * Handle the Licencia "force deleted" event.
     *
     * @param  \App\Licencia  $licencia
     * @return void
     */
    public function forceDeleted(Licencia $licencia)
    {
        //
    }
}
