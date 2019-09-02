<?php

namespace App\Http\Resources\Translado;

use Illuminate\Http\Resources\Json\JsonResource;

class Translado extends JsonResource
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
