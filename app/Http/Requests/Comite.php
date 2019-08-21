<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Comite extends FormRequest
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
            'observacion' => 'required|alpha_num_spaces',
            'cargo_postulante_id' => 'required|exists:cargo_postulantes,id',
            'persona_id' => 'required|integer|min:1',
            //'clave' => 'required|exists:calendarizaciones,clave'
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
