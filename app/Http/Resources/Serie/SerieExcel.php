<?php

namespace App\Http\Resources\Serie;

use Illuminate\Http\Resources\Json\JsonResource;

class SerieExcel extends JsonResource
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
            'resolucion'                    => $this->resolucion,
            'is_titular'                    => $this->is_titular,
            'representanteNombres'          => $this->representanteNombres,
            'representanteApellidoPaterno'  => $this->representanteApellidoPaterno,
            'representanteApellidoMaterno'  => $this->representanteApellidoMaterno,

            'documento'                     => isset( $this->documento->documento) ? $this->documento->documento : '',
            'persona'                       => isset( $this->persona->full_name) ? $this->persona->full_name : '',
            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
