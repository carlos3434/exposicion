<?php

namespace App\Http\Resources\Gasto;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Gasto\PersonaCollection;
use App\Http\Resources\Gasto\CargoCollection;
use App\Http\Resources\Gasto\DepartamentoCollection;

class Gasto extends JsonResource
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

            'persona'                   => new PersonaCollection($this->persona),
            'cargo'                     => new CargoCollection($this->cargo),
            'departamento'              => new DepartamentoCollection($this->departamento),
            'created_at'                => $this->created_at->toDateTimeString(),

        ];
    }
}
