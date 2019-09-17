<?php

namespace App\Observers;

use App\Empresa;
use Illuminate\Support\Facades\Auth;

class EmpresaObserver
{
    public function saving(Empresa $empresa)
    {
        
    }
    /**
     * Handle the Empresa "created" event.
     *
     * @param  \App\Empresa  $empresa
     * @return void
     */
    public function creating(Empresa $empresa)
    {
        $empresa->created_by = Auth::id();
        $empresa->updated_by = Auth::id();
    }

    /**
     * Handle the Empresa "updated" event.
     *
     * @param  \App\Empresa  $empresa
     * @return void
     */
    public function updating(Empresa $empresa)
    {
        $empresa->updated_by = Auth::id();
    }
    /**
     * Handle the Empresa "deleted" event.
     *
     * @param  \App\Empresa  $translado
     * @return void
     */
    public function deleting(Empresa $empresa)
    {
        $empresa->deleted_by = Auth::id();
    }
    /**
     * Handle the proceso disciplinario "created" event.
     *
     * @param  \App\Empresa  $empresa
     * @return void
     */
    public function created(Empresa $empresa)
    {

    }

    /**
     * Handle the proceso disciplinario "updated" event.
     *
     * @param  \App\Empresa  $empresa
     * @return void
     */
    public function updated(Empresa $empresa)
    {

    }

    /**
     * Handle the proceso disciplinario "deleted" event.
     *
     * @param  \App\Empresa  $empresa
     * @return void
     */
    public function deleted(Empresa $empresa)
    {

    }

    /**
     * Handle the proceso disciplinario "restored" event.
     *
     * @param  \App\Empresa  $empresa
     * @return void
     */
    public function restored(Empresa $empresa)
    {
        //
    }

    /**
     * Handle the proceso disciplinario "force deleted" event.
     *
     * @param  \App\Empresa  $empresa
     * @return void
     */
    public function forceDeleted(Empresa $empresa)
    {
        //
    }
}
