<?php

namespace App\Observers;

use App\Gasto;
use Illuminate\Support\Facades\Auth;

class GastoObserver
{
    public function saved(Gasto $gasto)
    {

    }
    public function saving(Gasto $gasto)
    {

    }
    /**
     * Handle the Gasto "created" event.
     *
     * @param  \App\Gasto  $gasto
     * @return void
     */
    public function creating(Gasto $gasto)
    {
        $gasto->created_by = Auth::id();
        $gasto->updated_by = Auth::id();
    }
    /**
     * Handle the Gasto "updated" event.
     *
     * @param  \App\Gasto  $gasto
     * @return void
     */
    public function updating(Gasto $gasto)
    {
        $gasto->updated_by = Auth::id();
    }
    /**
     * Handle the Gasto "deleted" event.
     *
     * @param  \App\Gasto  $translado
     * @return void
     */
    public function deleting(Gasto $gasto)
    {
        $gasto->deleted_by = Auth::id();
    }
    /**
     * Handle the gasto "created" event.
     *
     * @param  \App\Gasto  $gasto
     * @return void
     */
    public function created(Gasto $gasto)
    {
        //
    }

    /**
     * Handle the gasto "updated" event.
     *
     * @param  \App\Gasto  $gasto
     * @return void
     */
    public function updated(Gasto $gasto)
    {
        //
    }

    /**
     * Handle the gasto "deleted" event.
     *
     * @param  \App\Gasto  $gasto
     * @return void
     */
    public function deleted(Gasto $gasto)
    {
        //
    }

    /**
     * Handle the gasto "restored" event.
     *
     * @param  \App\Gasto  $gasto
     * @return void
     */
    public function restored(Gasto $gasto)
    {
        //
    }

    /**
     * Handle the gasto "force deleted" event.
     *
     * @param  \App\Gasto  $gasto
     * @return void
     */
    public function forceDeleted(Gasto $gasto)
    {
        //
    }
}
