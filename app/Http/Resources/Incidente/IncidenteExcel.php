<?php

namespace App\Http\Resources\Incidente;

use Illuminate\Http\Resources\Json\JsonResource;

class IncidenteExcel extends JsonResource
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
            'descripcion'                   => $this->descripcion,
            'documento'                     => $this->documento,

            'tipo_incidente'                => isset( $this->tipoIncidente->name) ? $this->tipoIncidente->name : '',
            'persona'                       => isset( $this->persona->full_name) ? $this->persona->full_name : '',
            'created_at'                    => $this->created_at->toDateTimeString(),
        ];

    }
}
