<?php

namespace App\Http\Resources\ListaPostulante;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaPostulante extends JsonResource
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
            'lista'                         => $this->lista,
            'proceso'                       => $this->proceso,
            'observacion'                   => $this->observacion,

            'cargo_postulante'              => new CargoPostulanteCollection( $this->cargoPostulante),
            'departamento'                  => new DepartamentoCollection( $this->departamento),
            'persona'                       => new PersonaCollection( $this->persona),

            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
