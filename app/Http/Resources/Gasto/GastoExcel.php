<?php

namespace App\Http\Resources\Gasto;

use Illuminate\Http\Resources\Json\JsonResource;

class GastoExcel extends JsonResource
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
            'id'                        => $this->id,
            'motivo'                    => $this->motivo,
            'origen'                    => $this->origen,
            'destino'                   => $this->destino,
            'retorno'                   => $this->retorno,
            'fecha_salida'              => $this->fecha_salida,
            'fecha_retorno'             => $this->fecha_retorno,
            'monto_recibido'            => $this->monto_recibido,
            'monto_retenido'            => $this->monto_retenido,
            'devolucion'                => $this->devolucion,
            'pendiente_rendicion'       => $this->pendiente_rendicion,
            'total'                     => $this->total,
            'fecha_registro'            => $this->fecha_registro,
            'apellido_paterno'          => $this->apellido_paterno,
            'apellido_materno'          => $this->apellido_materno,
            'nombres'                   => $this->nombres,

            'departamento'              => isset( $this->departamento->name) ? $this->departamento->name : '',
            //'persona'                   => isset( $this->persona->full_name) ? $this->persona->full_name : '',
            'cargo'                     => isset( $this->cargo->name) ? $this->cargo->name : '',

            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
