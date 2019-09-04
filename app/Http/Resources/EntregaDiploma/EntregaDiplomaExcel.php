<?php

namespace App\Http\Resources\EntregaDiploma;

use Illuminate\Http\Resources\Json\JsonResource;

class EntregaDiplomaExcel extends JsonResource
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
            //[ "id","departamento_id", "fecha_entrega", "cantidad", "observacion" , "created_at", "updated_at", "departamento"];
            'id'                            => $this->id,
            'departamento'                  => isset( $this->departamento->name) ? $this->departamento->name : '',
            'fecha_entrega'                 => $this->fecha_entrega,
            'cantidad'                      => $this->cantidad,
            'observacion'                   => $this->observacion,

            'created_at'                    => $this->created_at->toDateTimeString(),

        ];
    }
}
