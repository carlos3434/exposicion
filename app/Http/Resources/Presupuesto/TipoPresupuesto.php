<?php

namespace App\Http\Resources\Presupuesto;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoPresupuesto extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'codigo' => $this->codigo,
            'tipo' => $this->tipo,
        ];
    }
}
