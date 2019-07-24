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
            'fecha_registro' => 'required|date_format:Y-m-d',
            'resolucion' => 'required|alpha_num',
            'persona_id' => 'required|integer|min:1',
            'is_titular' => 'required|boolean',
            'representanteNombres' => 'required|alpha_num',
            'representanteApellidoPaterno' => 'required|alpha_num',
            'representanteApellidoMaterno' => 'required|alpha_num',
            'documento_id' => 'required|unique:proceso_disciplinarios,id',
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
