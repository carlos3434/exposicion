<?php

namespace App\Http\Resources\ResultadoEleccion;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultadoEleccion extends JsonResource
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
            'lista_ganadora'                => $this->lista_ganadora,
            'numero_votantes'               => $this->numero_votantes,
            'numero_novotantes'             => $this->numero_novotantes,
            'numero_votos'                  => $this->numero_votos,
            'observacion'                   => $this->observacion,
            'departamento'                  => new DepartamentoCollection( $this->departamento),
            //'departamento'                  => isset( $this->departamento->name) ? $this->departamento->name : '',
            'created_at'                    => $this->created_at->toDateTimeString(),

        ];
    }
}
