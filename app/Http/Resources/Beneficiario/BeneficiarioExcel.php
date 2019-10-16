<?php

namespace App\Http\Resources\Beneficiario;

use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiarioExcel extends JsonResource
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
            'nombres'                       => $this->nombres,
            'apellido_paterno'              => $this->apellido_paterno,
            'apellido_materno'              => $this->apellido_materno,
            //'tipo_documento_identidad_id'   => $this->tipo_documento_identidad_id,
            'numero_documento_identidad'    => $this->numero_documento_identidad,
            'direccion'                     => $this->direccion,
            'telefono'                      => $this->telefono,
            'email'                         => $this->email,
            'persona'                       => isset( $this->persona->full_name) ? $this->persona->full_name : '',
            'tipo_documento_identidad'      => isset( $this->tipoDocumentoIdentidad->name) ? $this->tipoDocumentoIdentidad->name : '',

            'created_at'                    => $this->created_at->toDateTimeString()

        ];
    }
}
