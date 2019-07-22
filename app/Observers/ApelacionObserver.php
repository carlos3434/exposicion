<?php

namespace App\Observers;

use App\Apelacion;
use Illuminate\Support\Facades\Auth;

class ApelacionObserver
{
    public function saving(Apelacion $apelacion)
    {
        
    }
    /**
     * Handle the Apelacion "created" event.
     *
     * @param  \App\Apelacion  $apelacion
     * @return void
     */
    public function creating(Apelacion $apelacion)
    {
        $apelacion->created_by = Auth::id();
        $apelacion->updated_by = Auth::id();
    }

    /**
     * Handle the Apelacion "updated" event.
     *
     * @param  \App\Apelacion  $apelacion
     * @return void
     */
    public function updating(Apelacion $apelacion)
    {
        $apelacion->updated_by = Auth::id();
    }
    /**
     * Handle the Apelacion "deleted" event.
     *
     * @param  \App\Apelacion  $translado
     * @return void
     */
    public function deleting(Apelacion $apelacion)
    {
        $apelacion->deleted_by = Auth::id();
    }
    /**
     * Handle the proceso disciplinario "created" event.
     *
     * @param  \App\Apelacion  $apelacion
     * @return void
     */
    public function created(Apelacion $apelacion)
    {

    }

    /**
     * Handle the proceso disciplinario "updated" event.
     *
     * @param  \App\Apelacion  $apelacion
     * @return void
     */
    public function updated(Apelacion $apelacion)
    {

    }

    /**
     * Handle the proceso disciplinario "deleted" event.
     *
     * @param  \App\Apelacion  $apelacion
     * @return void
     */
    public function deleted(Apelacion $apelacion)
    {

    }

    /**
     * Handle the proceso disciplinario "restored" event.
     *
     * @param  \App\Apelacion  $apelacion
     * @return void
     */
    public function restored(Apelacion $apelacion)
    {
        //
    }

    /**
     * Handle the proceso disciplinario "force deleted" event.
     *
     * @param  \App\Apelacion  $apelacion
     * @return void
     */
    public function forceDeleted(Apelacion $apelacion)
    {
        //
    }
}
