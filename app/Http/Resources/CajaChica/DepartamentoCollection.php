<?php

namespace App\Http\Resources\CajaChica;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartamentoCollection extends JsonResource
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
        return $this->collection->transform(function ($departamento) {
            return new Departamento($departamento);
        });
    }

}
