<?php

namespace App\Observers;

use App\Beneficiario;

class BeneficiarioObserver
{
    /**
     * Handle the Beneficiario "created" event.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return void
     */
    public function creating(Beneficiario $beneficiario)
    {
        $beneficiario->created_by = Auth::id();
        $beneficiario->updated_by = Auth::id();
    }

    /**
     * Handle the Beneficiario "updated" event.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return void
     */
    public function updating(Beneficiario $beneficiario)
    {
        $beneficiario->updated_by = Auth::id();
    }
    /**
     * Handle the Beneficiario "deleted" event.
     *
     * @param  \App\Beneficiario  $translado
     * @return void
     */
    public function deleting(Beneficiario $beneficiario)
    {
        $beneficiario->deleted_by = Auth::id();
    }
    /**
     * Handle the beneficiario "created" event.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return void
     */
    public function created(Beneficiario $beneficiario)
    {
        //
    }

    /**
     * Handle the beneficiario "updated" event.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return void
     */
    public function updated(Beneficiario $beneficiario)
    {
        //
    }

    /**
     * Handle the beneficiario "deleted" event.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return void
     */
    public function deleted(Beneficiario $beneficiario)
    {
        //
    }

    /**
     * Handle the beneficiario "restored" event.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return void
     */
    public function restored(Beneficiario $beneficiario)
    {
        //
    }

    /**
     * Handle the beneficiario "force deleted" event.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return void
     */
    public function forceDeleted(Beneficiario $beneficiario)
    {
        //
    }
}
