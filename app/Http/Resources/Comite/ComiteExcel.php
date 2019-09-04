<?php

namespace App\Http\Resources\Comite;

use Illuminate\Http\Resources\Json\JsonResource;

class ComiteExcel extends JsonResource
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
            "cargo_postulante"              => isset( $this->cargoPostulante->name) ? $this->cargoPostulante->name : '',
            "persona"                       => isset( $this->persona->full_name) ? $this->persona->full_name : '',
            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
