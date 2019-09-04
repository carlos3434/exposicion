<?php

namespace App\Http\Resources\Persona;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Persona\TipoDocumentoIdentidadCollection;
use App\Http\Resources\Persona\NacionalidadCollection;
use App\Http\Resources\Persona\EstadoCivilCollection;
use App\Http\Resources\Persona\UbigeoCollection;

use App\Http\Resources\Persona\UniversidadProcedenciaCollection;
use App\Http\Resources\Persona\EspecialidadPosgradoCollection;
use App\Http\Resources\Persona\AreaEjercicioProfesionalCollection;
use App\Http\Resources\Persona\DepartamentoColegiadoCollection;
use App\Http\Resources\Persona\EstadoRegistroColegiadoCollection;
use App\Http\Resources\Persona\EstadoCuentaSistemaCollection;


class PersonaExcel extends JsonResource
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
            'fecha_registro'                => $this->fecha_registro,
            'numero_documento_identidad'    => $this->numero_documento_identidad,

            'tipo_documento_identidad'      => isset( $this->tipoDocumentoIdentidad->name) ? $this->tipoDocumentoIdentidad->name : '',

            'nacionalidad'                  => isset( $this->nacionalidad->name) ? $this->nacionalidad->name : '',

            "apellido_paterno"              => $this->apellido_paterno,
            "apellido_materno"              => $this->apellido_materno,
            "nombres"                       => $this->nombres,
            "fecha_nacimiento"              => $this->fecha_nacimiento,

            'estado_civil'                  => isset( $this->estadoCivil->name) ? $this->estadoCivil->name : '',

            "conyuge_apellido_paterno"      => $this->conyuge_apellido_paterno,
            "conyuge_apellido_materno"      => $this->conyuge_apellido_materno,
            "conyuge_nombres"               => $this->conyuge_nombres,
            "numero_hijos"                  => $this->numero_hijos,

            'ubigeo'                        => isset( $this->ubigeo->name) ? $this->ubigeo->name : '',

            "direccion"                     => $this->direccion,
            "telefono_fijo"                 => $this->telefono_fijo,
            "celular_uno"                   => $this->celular_uno,
            "celular_dos"                   => $this->celular_dos,
            "email_uno"                     => $this->email_uno,
            "email_dos"                     => $this->email_dos,

            'universidad_procedencia'       => isset( $this->universidadProcedencia->name) ? $this->universidadProcedencia->name : '',

            "fecha_bachiller"               => $this->fecha_bachiller,
            "fecha_titulacion"              => $this->fecha_titulacion,

            "especialidad_posgrado"         => isset( $this->especialidadPosgrado->name) ? $this->especialidadPosgrado->name : '',
            "area_ejercicio_profesional"    => isset( $this->areaEjercicioProfesional->name) ? $this->areaEjercicioProfesional->name : '',

            "nombre_centro_laboral"         => $this->nombre_centro_laboral,
            "direccion_centro_laboral"      => $this->direccion_centro_laboral,
            "telefono_centro_laboral"       => $this->telefono_centro_laboral,
            "numero_cmvp"                   => $this->numero_cmvp,
            "fecha_registro_consejo"        => $this->fecha_registro_consejo,
            "url_cv"                        => $this->url_cv,
            "is_voluntario"                 => $this->is_voluntario,
            "grupo_sanguineo"               => $this->grupo_sanguineo,

            "departamento_colegiado"        => isset( $this->departamentoColegiado->name) ? $this->departamentoColegiado->name : '',
            
            "is_habilitado"                 => $this->is_habilitado,
            "is_incidencia"                 => $this->is_incidencia,
            "is_carnet"                     => $this->is_carnet,

            "estado_registro_colegiado"     => isset( $this->estadoRegistroColegiado->name) ? $this->estadoRegistroColegiado->name : '',

            "fecha_colegiatura"             => $this->is_habilitado,
            "fecha_aprovacion_consejo"      => $this->is_habilitado,
            "url_foto"                      => $this->is_habilitado,

            "estado_cuenta_sistema"         => isset( $this->estadoCuentaSistema->name) ? $this->estadoCuentaSistema->name : '',

            "ultimo_mes_pago"               => $this->ultimo_mes_pago,
            "numero_meses_deuda"            => $this->numero_meses_deuda,
            "total_deuda"                   => $this->total_deuda,
            "total_aportado"                => $this->total_aportado,
            "total_faf"                     => $this->total_faf,
            "total_adelanto"                => $this->total_adelanto,
            "total_departamental"           => $this->total_departamental,
            "total_consejo"                 => $this->total_consejo,
            "multa_pendiente"               => $this->multa_pendiente,
            "multa_pagadas"                 => $this->multa_pagadas,

            'created_at'                    => $this->created_at->toDateTimeString(),
            /*'roles' => new RolesByPersonaCollection($this->roles),
            'permissions' => new PermissionsByPersonaCollection($this->permissions)*/


        ];
    }
}
