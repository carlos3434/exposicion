<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteCollection extends JsonResource
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
            'razon_social' => $this->razon_social,
            'direccion' => $this->direccion,
            'numero_documento_identidad' => $this->numero_documento_identidad,
            //'tipo_documento_identidad' => $this->tipo_documento_identidad,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'email' => $this->email,
        ];
    }
}
