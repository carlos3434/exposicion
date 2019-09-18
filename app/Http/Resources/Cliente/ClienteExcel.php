<?php

namespace App\Http\Resources\Cliente;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Persona\TipoDocumentoIdentidadCollection;

class ClienteExcel extends JsonResource
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
            'id'                            => $this->id,
            'razon_social'                  => $this->razon_social,
            'direccion'                     => $this->direccion,

            'tipo_documento_identidad'      => isset( $this->tipoDocumentoIdentidad->id) ? : '',
            'numero_documento_identidad'    => isset( $this->tipoDocumentoIdentidad->name) ? : '',

            'telefono'                      => $this->telefono,
            'celular'                       => $this->celular,
            'email'                         => $this->email,

            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
