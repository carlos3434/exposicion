<?php

namespace App\Http\Resources\ListaGanadora;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaGanadora extends JsonResource
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
            'fecha_instalacion'             => $this->fecha_instalacion,
            'periodo'                       => $this->periodo,
            'credential_comite_electoral'   => $this->credential_comite_electoral,

            'cargo_postulante'              => new CargoPostulanteCollection( $this->cargoPostulante),
            'departamento'                  => new DepartamentoCollection( $this->departamento),
            'persona'                       => new PersonaCollection( $this->persona),
            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
