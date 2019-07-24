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
            'fecha_registro' => 'required|date_format:Y-m-d',
            'motivo' => 'required|alpha_num',
            'documento' => 'required|alpha_num',
            'origen_departamento_id' => 'required|unique:departamentos,id',
            'destino_departamento_id' => 'required|unique:departamentos,id',
            'persona_id' => 'required|integer|min:1',
            //'clave' => 'required|unique:calendarizaciones,clave'
        ];
    }
    public function messages()
    {
        return [
            'fecha_registro.required' => 'El :attribute es un campo requerido',
            'motivo.required' => 'El :attribute es un campo requerido',
            'documento.required' => 'El :attribute es un campo requerido',
            'origen_departamento_id.required' => 'El :attribute es un campo requerido',
            'destino_departamento_id.required' => 'El :attribute es un campo requerido',
            'persona_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
