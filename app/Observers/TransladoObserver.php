<?php

namespace App\Observers;

use App\Translado;
use Illuminate\Support\Facades\Auth;

class TransladoObserver
{
    public function saving(Translado $translado)
    {
        
    }
    /**
     * Handle the Translado "created" event.
     *
     * @param  \App\Translado  $translado
     * @return void
     */
    public function creating(Translado $translado)
    {
        $translado->created_by = Auth::id();
        $translado->updated_by = Auth::id();
    }

    /**
     * Handle the Translado "updated" event.
     *
     * @param  \App\Translado  $translado
     * @return void
     */
    public function updating(Translado $translado)
    {
        $translado->updated_by = Auth::id();
    }

    /**
     * Handle the Translado "deleted" event.
     *
     * @param  \App\Translado  $translado
     * @return void
     */
    public function deleting(Translado $translado)
    {
        $translado->deleted_by = Auth::id();
    }

    /**
     * Handle the Translado "restored" event.
     *
     * @param  \App\Translado  $translado
     * @return void
     */
    public function restored(Translado $translado)
    {
        //
    }

    /**
     * Handle the Translado "force deleted" event.
     *
     * @param  \App\Translado  $translado
     * @return void
     */
    public function forceDeleted(Translado $translado)
    {
        //
    }
}
