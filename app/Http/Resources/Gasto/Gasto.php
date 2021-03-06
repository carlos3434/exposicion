<?php

namespace App\Http\Resources\Gasto;

use Illuminate\Http\Resources\Json\JsonResource;

//use App\Http\Resources\Gasto\PersonaCollection;
use App\Http\Resources\Gasto\CargoCollection;
use App\Http\Resources\Gasto\DepartamentoCollection;
use App\Http\Resources\Gasto\GastoDetailCollection;

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
        $persona = new \stdClass;
        $persona->full_name = $this->apellido_paterno . ' ' . $this->apellido_materno .' '. $this->nombres;

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

            'persona'                   => $persona,
            'cargo'                     => new CargoCollection($this->cargo),
            'departamento'              => new DepartamentoCollection($this->departamento),
            'detail'                    => new GastoDetailCollection($this->gastoDetail),
            'created_at'                => $this->created_at->toDateTimeString(),

        ];
    }
}
