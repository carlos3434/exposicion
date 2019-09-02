<?php

namespace App\Http\Resources\ListaGanadora;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaGanadora extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
