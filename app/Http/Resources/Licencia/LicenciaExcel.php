<?php

namespace App\Http\Resources\Licencia;

use Illuminate\Http\Resources\Json\JsonResource;

class LicenciaExcel extends JsonResource
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
            //[ "id","fecha_registro", "motivo", "documento", "fecha_inicio" , "fecha_fin", "persona_id","created_at"]
            'id'                            => $this->id,
            'fecha_registro'                => $this->fecha_registro,
            'motivo'                        => $this->motivo,
            'documento'                     => $this->documento,
            'fecha_inicio'                  => $this->fecha_inicio,
            'fecha_fin'                     => $this->fecha_fin,

            'persona'                       => isset( $this->persona->full_name) ? $this->persona->full_name : '',
            'created_at'                    => $this->created_at->toDateTimeString(),
            /*'roles' => new RolesByPersonaCollection($this->roles),
            'permissions' => new PermissionsByPersonaCollection($this->permissions)*/


        ];

    }
}
