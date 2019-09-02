<?php

namespace App\Http\Resources\Apelacion;

use Illuminate\Http\Resources\Json\JsonResource;

class Apelacion extends JsonResource
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
