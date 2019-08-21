<?php

namespace App\Observers;

use App\Persona;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Storage;

class PersonaObserver
{

    public function saved(Persona $persona)
    {

    }
    public function saving(Persona $persona)
    {
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$persona->url_foto));
        //Image::make($image)->resize(300,300)->save($s3);
        $profileImg= Image::make($image)->stream();

        $fileName = time().'.png';
        Storage::put('uploads/photos/'.$fileName, $profileImg, 'public');

        $persona->url_foto = $fileName;
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
