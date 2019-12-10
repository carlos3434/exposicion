<?php

namespace App\Observers;

use App\Persona;
use App\Cliente;
use App\TipoDocumentoIdentidad;
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
        $persona->fecha_registro = date("Y-m-d");
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
        if ($persona->isDirty('ruc')){
            // email has changed
            Cliente::where('persona_id',$persona->id)
            ->where('tipo_documento_identidad_id',TipoDocumentoIdentidad::RUC)
            ->update(['numero_documento_identidad' => $persona->ruc]);
        }
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
