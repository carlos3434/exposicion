<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Beneficiario extends FormRequest
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
            'nombres'                           => 'required|alpha_num_spaces',
            'apellido_paterno'                  => 'required|alpha_num_spaces',
            'apellido_materno'                  => 'required|alpha_num_spaces',
            'tipo_documento_identidad_id'       => 'required|exists:tipo_documento_identidad,id',
            'numero_documento_identidad'        => 'required|integer|numero_documento_identidad',
            'persona_id'                        => 'required|exists:personas,id',
            'direccion'                         => 'alpha_num_spaces',
            'telefono'                          => 'integer',
            'email'                             => 'email'
        ];
    }
    public function messages()
    {
        return [
            'fecha_registro.required' => 'El :attribute es un campo requerido',
            'motivo.required' => 'El :attribute es un campo requerido',
            'documento.required' => 'El :attribute es un campo requerido',
            'fecha_inicio.required' => 'El :attribute es un campo requerido',
            'fecha_fin.required' => 'El :attribute es un campo requerido',
            'persona_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
