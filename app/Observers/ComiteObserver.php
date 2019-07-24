<?php

namespace App\Observers;

use App\Comite;
use Illuminate\Support\Facades\Auth;

class ComiteObserver
{
    public function saving(Comite $comite)
    {
        
    }
    /**
     * Handle the Comite "created" event.
     *
     * @param  \App\Comite  $comite
     * @return void
     */
    public function creating(Comite $comite)
    {
        $comite->created_by = Auth::id();
        $comite->updated_by = Auth::id();
    }

    /**
     * Handle the Comite "updated" event.
     *
     * @param  \App\Comite  $comite
     * @return void
     */
    public function updating(Comite $comite)
    {
        $comite->updated_by = Auth::id();
    }
    /**
     * Handle the Comite "deleted" event.
     *
     * @param  \App\Comite  $translado
     * @return void
     */
    public function deleting(Comite $comite)
    {
        $comite->deleted_by = Auth::id();
    }
    /**
     * Handle the comite "created" event.
     *
     * @param  \App\Comite  $comite
     * @return void
     */
    public function created(Comite $comite)
    {
        //
    }

    /**
     * Handle the comite "updated" event.
     *
     * @param  \App\Comite  $comite
     * @return void
     */
    public function updated(Comite $comite)
    {
        //
    }

    /**
     * Handle the comite "deleted" event.
     *
     * @param  \App\Comite  $comite
     * @return void
     */
    public function deleted(Comite $comite)
    {
        //
    }

    /**
     * Handle the comite "restored" event.
     *
     * @param  \App\Comite  $comite
     * @return void
     */
    public function restored(Comite $comite)
    {
        //
    }

    /**
     * Handle the comite "force deleted" event.
     *
     * @param  \App\Comite  $comite
     * @return void
     */
    public function forceDeleted(Comite $comite)
    {
        //
    }
}
