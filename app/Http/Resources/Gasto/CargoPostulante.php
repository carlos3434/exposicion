<?php

namespace App\Http\Resources\Gasto;

use Illuminate\Http\Resources\Json\JsonResource;

class CargoPostulante extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id'                            => $this->id,
            'name'                          => $this->name,

            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
