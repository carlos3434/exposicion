<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaCollection extends JsonResource
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
            'id' => $this->id,
            'ruc' => $this->ruc,
            'nombre_comercial' => $this->nombre_comercial,
            'razon_social' => $this->razon_social,
        ];
    }
}
