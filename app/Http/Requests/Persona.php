<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Persona extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fecha_registro'                    => 'date_format:Y-m-d',
            'tipo_documento_identidad_id'       => 'required|exists:tipo_documento_identidad,id',
            'numero_documento_identidad'        => 'required|unique:personas,numero_documento_identidad,'. (isset($this->persona->id) ? $this->persona->id : 0),
            'nacionalidad_id'                   => 'required|integer',
            'apellido_paterno'                  => 'required|string',
            'apellido_materno'                  => 'required|string',
            'nombres'                           => 'required|string',
            'ruc'                               => 'integer|digits:11|unique:personas,ruc,'. (isset($this->persona->id) ? $this->persona->id : 0),
            'fecha_nacimiento'                  => 'required|date_format:Y-m-d',
            'estado_civil_id'                   => 'required|exists:estado_civil,id',
            'conyuge_apellido_paterno'          => 'string',
            'conyuge_apellido_materno'          => 'string',
            'conyuge_nombres'                   => 'string',
            'numero_hijos'                      => 'integer',
            'departamento_id'                   => 'required|exists:ubigeos,id',
            'distrito_id'                       => 'required|exists:ubigeos,id',
            'provincia_id'                      => 'required|exists:ubigeos,id',
            'direccion'                         => 'required|string',
            'telefono_fijo'                     => 'integer',
            'celular_uno'                       => 'integer',
            'celular_dos'                       => 'integer',
            'email_uno'                         => 'email',
            'email_dos'                         => 'email',
            'universidad_procedencia_id'        => 'exists:universidades,id',
            'fecha_bachiller'                   => 'date_format:Y-m-d',
            'fecha_titulacion'                  => 'date_format:Y-m-d',

            'fecha_inscripcion'                 => 'date_format:Y-m-d',
            'fecha_presentacion_solicitud'      => 'date_format:Y-m-d',
            'fecha_sesion'                      => 'date_format:Y-m-d',
            'fecha_llegada_solicitud'           => 'date_format:Y-m-d',
            'fecha_registro_carnet'             => 'date_format:Y-m-d',
            'fecha_emision_carnet'              => 'date_format:Y-m-d',
            'fecha_caducidad_carnet'            => 'date_format:Y-m-d',
            'fecha_juramentacion'               => 'date_format:Y-m-d',
            'fecha_solicitud_faf'               => 'date_format:Y-m-d',
            'fecha_recepcion_faf'               => 'date_format:Y-m-d',
            'fecha_firma_consejo'               => 'date_format:Y-m-d',

            'numero_operacion'                  => 'string',
            'banco_operacion'                   => 'string',
            'fecha_operacion'                   => 'date_format:Y-m-d',
            'monto_operacion'                   => 'integer',

            'especialidad_posgrado_id'          => 'exists:especialidad_posgrado,id',
            'area_ejercicio_profesional_id'     => 'exists:area_ejercicio_profesional,id',
            'nombre_centro_laboral'             => 'string',
            'direccion_centro_laboral'          => 'string',
            'telefono_centro_laboral'           => 'integer',
            'numero_cmvp'                       => 'string',
            'fecha_aprobacion_consejo'          => 'date_format:Y-m-d',
            'url_cv'                            => 'file|max:16192',
            'is_voluntario'                     => 'boolean',
            'is_pago_colegiatura'               => 'boolean',
            'is_inscripcion'                    => 'boolean',
            'is_solicitud'                      => 'boolean',
            'is_pago_cuota_mensual'             => 'boolean',
            'grupo_sanguineo'                   => 'string',
            'departamento_colegiado_id'         => 'required|exists:ubigeos,id',
            'is_habilitado'                     => 'boolean',
            'is_juramentacion_programada'       => 'boolean',
            'is_juramentacion_validada'         => 'boolean',
            'numero_incidencias'                => 'integer',
            'numero_procesos_disciplinarios'    => 'integer',
            'is_carnet'                         => 'boolean',
            'is_resuelve_consejo'               => 'boolean',
            'estado_registro_colegiado_id'      => 'exists:estado_registro_colegiado,id',
            'fecha_colegiatura'                 => 'date_format:Y-m-d',
            'fecha_resuelve_consejo'            => 'date_format:Y-m-d',
            'estado_cuenta_sistema_id'          => 'exists:estado_cuenta_sistema,id',
            'ultimo_mes_pago'                   => 'alpha_num',
            'numero_meses_deuda'                => 'integer',
            'total_deuda'                       => 'numeric|between:0,9999.99',
            'total_aportado'                    => 'numeric|between:0,9999.99',
            'total_faf'                         => 'numeric|between:0,9999.99',
            'total_adelanto'                    => 'numeric|between:0,9999.99',
            'total_departamental'               => 'numeric|between:0,9999.99',
            'total_consejo'                     => 'numeric|between:0,9999.99',
            'multa_pendiente'                   => 'numeric|between:0,9999.99',
            'multa_pagadas'                     => 'numeric|between:0,9999.99',
            'numero_meses_adelanto'             => 'numeric|between:0,9999.99',
            'numero_meses_aportado'             => 'numeric|between:0,9999.99'
        ];
    }
    public function messages()
    {
        return [
            'observacion.required' => 'El :attribute es un campo requerido',
            'cargo_postulante_id.required' => 'El :attribute es un campo requerido',
            'persona_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
