<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntregaDiploma extends FormRequest
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
            'departamento_id' => 'required|exists:ubigeos,id',
            'fecha_entrega' => 'required|date_format:Y-m-d',
            'cantidad' => 'required|integer|min:1',
            'observacion' => 'alpha_num_spaces'
            //'clave' => 'required|exists:calendarizaciones,clave'
        ];
    }
    public function messages()
    {
        return [
            'departamento_id.required' => 'El :attribute es un campo requerido',
            'fecha_entrega.required' => 'El :attribute entrega es un campo requerido',
            'fecha_entrega.date_format' => 'El :attribute entrega debe ser fecha con formato Y-m-d',
            'cantidad.required' => 'El :attribute es un campo requerido',
            'cantidad.integer' => 'El :attribute debe ser entero mayor a 1',
            'observacion.alpha_num' => 'El :attribute debe solo contener numeros y letras'
            // ..
        ];
    }
}
