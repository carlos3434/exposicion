<?php

namespace App\Http\Resources\Beneficiario;

use Illuminate\Http\Resources\Json\JsonResource;

class Beneficiario extends JsonResource
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
