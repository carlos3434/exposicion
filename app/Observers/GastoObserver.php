<?php

namespace App\Observers;

use App\Gasto;

class GastoObserver
{
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
