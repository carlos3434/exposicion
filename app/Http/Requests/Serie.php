<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Serie extends FormRequest
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
            'resolucion' => 'required|alpha_num_spaces',
            'persona_id' => 'required|integer|min:1',
            'is_titular' => 'required|boolean',
            'representanteNombres' => 'required|alpha_num_spaces',
            'representanteApellidoPaterno' => 'required|alpha_num_spaces',
            'representanteApellidoMaterno' => 'required|alpha_num_spaces',
            'documento_id' => 'required|exists:proceso_disciplinarios,id',
            //'clave' => 'required|exists:calendarizaciones,clave'
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
