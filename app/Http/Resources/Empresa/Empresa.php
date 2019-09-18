<?php

namespace App\Http\Resources\Empresa;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Empresa\UbigeoCollection;

class Empresa extends JsonResource
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
            'id'                    => $this->id,
            'ruc'                   => $this->ruc,
            'nombre_comercial'      => $this->nombre_comercial,
            'certificado_digital'   => $this->certificado_digital,
            'direccion_web'         => $this->direccion_web,
            'telefono'              => $this->telefono,
            'email'                 => $this->email,
            'direccion'             => $this->direccion,
            'logo'                  => $this->logo,
            'ubigeo'                => new UbigeoCollection($this->ubigeo),
            'created_at'            => $this->created_at->toDateTimeString(),
        ];
    }
}
