<?php

namespace App\Http\Resources\Translado;

use Illuminate\Http\Resources\Json\JsonResource;

class TransladoExcel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'                            => $this->id,
            'fecha_registro'                => $this->fecha_registro,
            'motivo'                        => $this->motivo,
            'documento'                     => $this->documento,
            'origen_departamento'           => isset( $this->origenDepartamento->name) ? $this->origenDepartamento->name : '',
            'destino_departamento'          => isset( $this->destinoDepartamento->name) ? $this->destinoDepartamento->name : '',
            'persona'                       => isset( $this->persona->full_name) ? $this->persona->full_name : '',
            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
