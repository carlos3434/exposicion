<?php

namespace App\Http\Resources\Presupuesto;

use Illuminate\Http\Resources\Json\JsonResource;

class Presupuesto extends JsonResource
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
            'id'                => $this->id,

            'monto'             => $this->monto,
            'mes'               => $this->mes,
            'departamento'      => new Departamento($this->departamento),
            'concepto'          => new Concepto($this->concepto),
            'tipo_presupuesto'  => new TipoPresupuesto($this->tipoPresupuesto),

            'created_at'        => $this->created_at->toDateTimeString(),
        ];
    }
}
