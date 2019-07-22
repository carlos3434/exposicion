<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Translado extends FormRequest
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
            'descripcion' => 'required',
            'documento' => 'required',
            'tipo_incidente_id' => 'required',
            'persona_id' => 'required',
            //'clave' => 'required|unique:calendarizaciones,clave'
        ];
    }
    public function messages()
    {
        return [
            'fecha_registro.required' => 'El :attribute es un campo requerido',
            'descripcion.required' => 'El :attribute es un campo requerido',
            'documento.required' => 'El :attribute es un campo requerido',
            'tipo_incidente_id.required' => 'El :attribute es un campo requerido',
            'persona_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
