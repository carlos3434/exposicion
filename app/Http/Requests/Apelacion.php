<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Apelacion extends FormRequest
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
            'fecha_registro' => 'required',
            'resolucion' => 'required',
            'persona_id' => 'required',
            'is_titular' => 'required',
            'representanteNombres' => 'required',
            'representanteApellidoPaterno' => 'required',
            'representanteApellidoMaterno' => 'required',
            'documento_id' => 'required',
            //'clave' => 'required|unique:calendarizaciones,clave'
        ];
    }
    public function messages()
    {
        return [
            'fecha_registro.required' => 'El :attribute es un campo requerido',
            'resolucion.required' => 'El :attribute es un campo requerido',
            'persona_id.required' => 'El :attribute es un campo requerido',
            'is_titular.required' => 'El :attribute es un campo requerido',
            'representanteNombres.required' => 'El :attribute es un campo requerido',
            'representanteApellidoPaterno.required' => 'El :attribute es un campo requerido',
            'representanteApellidoMaterno.required' => 'El :attribute es un campo requerido',
            'documento_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
