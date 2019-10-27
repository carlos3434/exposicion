<?php

namespace App\Http\Resources\Gasto;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonaCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                            => $this->id,
            'full_name'                     => $this->full_name,
            "apellido_paterno"              => $this->apellido_paterno,
            "apellido_materno"              => $this->apellido_materno,
            "nombres"                       => $this->nombres,
            "fecha_nacimiento"              => $this->fecha_nacimiento,
            'fecha_registro'                => $this->fecha_registro,
            'numero_documento_identidad'    => $this->numero_documento_identidad,

            "numero_cmvp"                   => $this->numero_cmvp,
            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
