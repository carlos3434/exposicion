<?php

namespace App\Http\Resources\ListaGanadora;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonaCollection extends JsonResource
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->full_name,
        ];
    }

}
