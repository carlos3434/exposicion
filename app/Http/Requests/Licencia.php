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
            'url_documento'       => 'file|max:2048',
            'fecha_registro' => 'required|date_format:Y-m-d',
            'motivo' => 'required|alpha_num_spaces',
            'documento' => 'required|alpha_num_spaces',
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'fecha_fin' => 'required|date_format:Y-m-d',
            'persona_id' => 'required|exists:personas,id',
            //'clave' => 'required|exists:calendarizaciones,clave'
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
