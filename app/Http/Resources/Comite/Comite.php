<?php

namespace App\Http\Resources\Comite;

use Illuminate\Http\Resources\Json\JsonResource;

class Comite extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                            => $this->id,
            'fecha_registro'                => $this->fecha_registro,
            'observacion'                   => $this->observacion,
            'cargo_postulante'              => new CargoPostulanteCollection( $this->cargoPostulante),
            'persona'                       => new PersonaCollection( $this->persona),
            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
