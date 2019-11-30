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


class Persona extends JsonResource
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

            'tipo_documento_identidad'      => new TipoDocumentoIdentidadCollection($this->tipoDocumentoIdentidad),

            'nacionalidad'                  => new NacionalidadCollection($this->nacionalidad),

            "apellido_paterno"              => $this->apellido_paterno,
            "apellido_materno"              => $this->apellido_materno,
            "nombres"                       => $this->nombres,
            "ruc"                           => $this->ruc,
            "fecha_nacimiento"              => $this->fecha_nacimiento,

            'estado_civil'                  => new EstadoCivilCollection($this->estadoCivil),

            "conyuge_apellido_paterno"      => $this->conyuge_apellido_paterno,
            "conyuge_apellido_materno"      => $this->conyuge_apellido_materno,
            "conyuge_nombres"               => $this->conyuge_nombres,
            "numero_hijos"                  => $this->numero_hijos,

            'departamento'                  => new UbigeoCollection($this->departamento),
            'distrito'                      => new UbigeoCollection($this->distrito),
            'provincia'                     => new UbigeoCollection($this->provincia),

            "direccion"                     => $this->direccion,
            "telefono_fijo"                 => $this->telefono_fijo,
            "celular_uno"                   => $this->celular_uno,
            "celular_dos"                   => $this->celular_dos,
            "email_uno"                     => $this->email_uno,
            "email_dos"                     => $this->email_dos,

            'universidad_procedencia'       => new UniversidadProcedenciaCollection($this->universidadProcedencia),

            "fecha_bachiller"               => $this->fecha_bachiller,
            "fecha_titulacion"              => $this->fecha_titulacion,

            "especialidad_posgrado"         => new EspecialidadPosgradoCollection($this->especialidadPosgrado),
            "area_ejercicio_profesional"    => new AreaEjercicioProfesionalCollection($this->areaEjercicioProfesional),

            "nombre_centro_laboral"         => $this->nombre_centro_laboral,
            "direccion_centro_laboral"      => $this->direccion_centro_laboral,
            "telefono_centro_laboral"       => $this->telefono_centro_laboral,
            "numero_cmvp"                   => $this->numero_cmvp,
            "fecha_aprobacion_consejo"      => $this->fecha_aprobacion_consejo,
            "url_cv"                        => $this->url_cv,
            "is_voluntario"                 => $this->is_voluntario,
            "grupo_sanguineo"               => $this->grupo_sanguineo,

            "departamento_colegiado"        => new DepartamentoColegiadoCollection($this->departamentoColegiado),
            
            "is_habilitado"                 => $this->is_habilitado,
            "is_juramentacion_programada"   => $this->is_juramentacion_programada,
            "is_juramentacion_validada"     => $this->is_juramentacion_validada,
            "numero_incidencias"            => $this->numero_incidencias,
            "numero_procesos_disciplinarios"=> $this->numero_procesos_disciplinarios,
            "is_carnet"                     => $this->is_carnet,
            "is_resuelve_consejo"           => $this->is_resuelve_consejo,
            'is_pago_colegiatura'           => $this->is_pago_colegiatura,
            'is_inscripcion'                => $this->is_inscripcion,
            'is_solicitud'                  => $this->is_solicitud,
            'is_licencia'                   => $this->is_licencia,
            'is_pago_cuota_mensual'         => $this->is_pago_cuota_mensual,

            "estado_registro"               => new EstadoRegistroColegiadoCollection($this->estadoRegistroColegiado),

            "fecha_colegiatura"             => $this->fecha_colegiatura,
            "fecha_resuelve_consejo"        => $this->fecha_resuelve_consejo,
            "url_foto"                      => $this->url_foto,

            "estado_cuenta"                 => new EstadoCuentaSistemaCollection($this->estadoCuentaSistema),
            "estado_solicitud"              => $this->estado_solicitud,

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
            "numero_meses_adelanto"         => $this->numero_meses_adelanto,
            "numero_meses_aportado"         => $this->numero_meses_aportado,

            'numero_operacion'              => $this->numero_operacion,
            'banco_operacion'               => $this->banco_operacion,
            'fecha_operacion'               => $this->fecha_operacion,
            'monto_operacion'               => $this->monto_operacion,

            'fecha_inscripcion'             => $this->fecha_inscripcion,
            'fecha_presentacion_solicitud'  => $this->fecha_presentacion_solicitud,
            'fecha_sesion'                  => $this->fecha_sesion,
            'fecha_llegada_solicitud'       => $this->fecha_llegada_solicitud,
            'fecha_registro_carnet'         => $this->fecha_registro_carnet,
            'fecha_emision_carnet'          => $this->fecha_emision_carnet,
            'fecha_caducidad_carnet'        => $this->fecha_caducidad_carnet,
            'fecha_juramentacion'           => $this->fecha_juramentacion,
            'fecha_solicitud_faf'           => $this->fecha_solicitud_faf,
            'fecha_recepcion_faf'           => $this->fecha_recepcion_faf,
            'fecha_firma_consejo'           => $this->fecha_firma_consejo,

            'created_at'                    => $this->created_at->toDateTimeString(),
            /*'roles' => new RolesByPersonaCollection($this->roles),
            'permissions' => new PermissionsByPersonaCollection($this->permissions)*/


        ];
    }
}
