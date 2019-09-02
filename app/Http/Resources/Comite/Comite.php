<?php

namespace App\Http\Resources\Comite;

use Illuminate\Http\Resources\Json\JsonResource;

class Comite extends JsonResource
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
