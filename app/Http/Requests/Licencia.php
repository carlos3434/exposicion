<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Licencia extends FormRequest
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
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'fecha_fin' => 'required|date_format:Y-m-d',
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
            'fecha_inicio.required' => 'El :attribute es un campo requerido',
            'fecha_fin.required' => 'El :attribute es un campo requerido',
            'persona_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}