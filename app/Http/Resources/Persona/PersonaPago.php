<?php

namespace App\Http\Resources\Persona;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Persona\TipoDocumentoIdentidadCollection;
use App\Http\Resources\Persona\PagoCollection;


class PersonaPago extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [

            'id'                            => $this->id,
            //'pagos'                         => $this->pagos,
            'pagos'                         => new PagoCollection($this->pagos),
            'fecha_registro'                => $this->fecha_registro,
            'numero_documento_identidad'    => $this->numero_documento_identidad,

            'tipo_documento_identidad'      => new TipoDocumentoIdentidadCollection($this->tipoDocumentoIdentidad),

            //'nacionalidad'                  => new NacionalidadCollection($this->nacionalidad),

            "apellido_paterno"              => $this->apellido_paterno,
            "apellido_materno"              => $this->apellido_materno,
            "nombres"                       => $this->nombres,
            "ruc"                           => $this->ruc,
            "fecha_nacimiento"              => $this->fecha_nacimiento,
            "full_name"                     => $this->fullName,

            "direccion"                     => $this->direccion,
            "telefono_fijo"                 => $this->telefono_fijo,
            "celular_uno"                   => $this->celular_uno,
            "email_uno"                     => $this->email_uno,
            "numero_cmvp"                   => $this->numero_cmvp,

            'created_at'                    => $this->created_at->toDateTimeString(),
            /*'roles' => new RolesByPersonaCollection($this->roles),
            'permissions' => new PermissionsByPersonaCollection($this->permissions)*/


        ];
    }
}
