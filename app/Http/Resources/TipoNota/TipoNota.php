<?php

namespace App\Http\Resources\TipoNota;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoNota extends JsonResource
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
            'id'                                    => $this->id,
            'name'                               => $this->name,
            'tipo'                               => $this->tipo
        ];
    }
}
