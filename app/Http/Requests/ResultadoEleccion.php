<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultadoEleccion extends FormRequest
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
            'lista_ganadora' => 'required|alpha_num',
            'numero_votantes' => 'required|integer',
            'numero_novotantes' => 'required|integer',
            'numero_votos' => 'required|integer',
            'observacion' => 'required|alpha_num',
            'departamento_id' => 'required|unique:departamentos,id',

            //'clave' => 'required|unique:calendarizaciones,clave'
        ];
    }
    public function messages()
    {
        return [
            'fecha_registro.required' => 'El :attribute es un campo requerido',
            'lista_ganadora.required' => 'El :attribute es un campo requerido',
            'numero_votantes.required' => 'El :attribute es un campo requerido',
            'numero_novotantes.required' => 'El :attribute es un campo requerido',
            'numero_votos.required' => 'El :attribute es un campo requerido',
            'observacion.required' => 'El :attribute es un campo requerido',
            'departamento_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
