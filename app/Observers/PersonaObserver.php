<?php

namespace App\Observers;

use App\Persona;
use Illuminate\Support\Facades\Auth;

class PersonaObserver
{

    public function saved(Persona $persona)
    {

    }
    public function saving(Persona $persona)
    {

    }
    /**
     * Handle the Persona "created" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function creating(Persona $persona)
    {
        $persona->created_by = Auth::id();
        $persona->updated_by = Auth::id();
    }

    /**
     * Handle the Persona "updated" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function updating(Persona $persona)
    {
        $persona->updated_by = Auth::id();
    }
    /**
     * Handle the Persona "deleted" event.
     *
     * @param  \App\Persona  $translado
     * @return void
     */
    public function deleting(Persona $persona)
    {
        $persona->deleted_by = Auth::id();
    }
    /**
     * Handle the Persona "created" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function created(Persona $persona)
    {
        //
    }

    /**
     * Handle the Persona "updated" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function updated(Persona $persona)
    {
        //
    }

    /**
     * Handle the Persona "deleted" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function deleted(Persona $persona)
    {
        //
    }

    /**
     * Handle the Persona "restored" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function restored(Persona $persona)
    {
        //
    }

    /**
     * Handle the Persona "force deleted" event.
     *
     * @param  \App\Persona  $persona
     * @return void
     */
    public function forceDeleted(Persona $persona)
    {
        //
    }
}
