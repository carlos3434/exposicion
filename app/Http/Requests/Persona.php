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
            'fecha_registro' => 'required|date_format:Y-m-d',
            'dni' => 'required|integer',
            'nacionalidad_id' => 'required|integer',
            'apellido_paterno' => 'required|alpha_num',
            'apellido_materno' => 'required|alpha_num',
            'nombres' => 'required|alpha_num',
            'fecha_nacimiento' => 'required|date_format:Y-m-d',
            'estado_civil_id' => 'required|integer',
            'conyuge_apellido_paterno' => 'alpha_num',
            'conyuge_apellido_materno' => 'alpha_num',
            'conyuge_nombres' => 'alpha_num',
            'numero_hijos' => 'integer',
            'departamento_id' => 'required|integer',
            'provincia_id' => 'required|integer',
            'distrito_id' => 'required|integer',
            'direccion' => 'required|alpha_num',
            'telefono_fijo' => 'integer',
            'celular_uno' => 'integer',
            'celular_dos' => 'integer',
            'email_uno' => 'email',
            'email_dos' => 'email',
            'universidad_procedencia_id' => 'integer',
            'fecha_bachiller' => 'date_format:Y-m-d',
            'fecha_titulacion' => 'date_format:Y-m-d',
            'especialidad_posgrado_id' => 'integer',
            'area_ejercicio_profesional_id' => 'integer',
            'nombre_centro_laboral' => 'alpha_num',
            'direccion_centro_laboral' => 'alpha_num',
            'telefono_centro_laboral' => 'integer',
            'numero_cmvp' => 'alpha_num',
            'fecha_registro_consejo' => 'date_format:Y-m-d',
            'url_cv' => 'alpha_num',
            'is_voluntario' => 'boolean',
            'grupo_sanguineo' => 'alpha_num',
            'departamento_colegiado_id' => 'required|integer',
            'is_habilitado' => 'boolean',
            'is_incidencia' => 'boolean',
            'is_carnet' => 'boolean',
            'estado_registro_id' => 'integer',
            'fecha_colegiatura' => 'date_format:Y-m-d',
            'fecha_aprovacion_consejo' => 'date_format:Y-m-d',
            'url_foto' => 'alpha_num',
            'estado_cuenta_id' => 'integer',
            'ultimo_mes_pago' => 'alpha_num',
            'numero_meses_deuda' => 'integer',
            'total_deuda' => 'numeric|between:0,9999.99',
            'total_aportado' => 'numeric|between:0,9999.99',
            'total_faf' => 'numeric|between:0,9999.99',
            'total_adelanto' => 'numeric|between:0,9999.99',
            'total_departamental' => 'numeric|between:0,9999.99',
            'total_consejo' => 'numeric|between:0,9999.99',
            'multa_pendiente' => 'numeric|between:0,9999.99',
            'multa_pagadas' => 'numeric|between:0,9999.99'
        ];
    }
    public function messages()
    {
        return [
            'fecha_registro.required' => 'El :attribute es un campo requerido',
            'observacion.required' => 'El :attribute es un campo requerido',
            'cargo_postulante_id.required' => 'El :attribute es un campo requerido',
            'persona_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
