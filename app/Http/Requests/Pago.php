<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Pago extends FormRequest
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
            'monto'               => 'required|numeric|between:0,9999',
            //'name'     => 'required_if:is_fraccion,1|integer',
            //'is_primera_cuota'     => 'required_if:is_fraccion,1|integer',
            'is_fraccion'         => 'required|boolean',
            'fecha_vencimiento'   => 'required|date_format:Y-m-d',
            'estado_pago_id'      => 'required|exists:estado_pagos,id',
            'concepto_id'         => 'required|exists:conceptos,id',
            'persona_id'          => 'required|exists:personas,id',
            'pago_id'             => 'required_if:is_fraccion,1|exists:pagos,id',
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
