<?php

namespace App\Http\Resources\ListaPostulante;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaPostulanteExcel extends JsonResource
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

            'cargo_postulante'              => isset( $this->cargoPostulante->name) ? $this->cargoPostulante->name : '',
            'departamento'                  => isset( $this->departamento->name) ? $this->departamento->name : '',
            'persona'                       => isset( $this->persona->full_name) ? $this->persona->full_name : '',
            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
