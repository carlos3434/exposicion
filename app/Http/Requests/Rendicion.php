<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Rendicion extends FormRequest
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

            'periodo'                           => 'alpha_num_spaces',
            'tipo_rendicion_id'                 => 'required|exists:tipo_rendicion,id',
            'fecha'                             => 'required|date_format:Y-m-d',
            'tipo_documento_pago_id'            => 'required|exists:tipo_documento_pago,id',
            'departamento_id'                   => 'required|exists:ubigeos,id',
            'concepto_id'                       => 'required|exists:conceptos,id',
            'serie'                             => 'alpha_num',
            'numero'                            => 'alpha_num',
            'tipo_documento_identidad_id'       => 'required|exists:tipo_documento_identidad,id',
            'numero_documento_identidad'        => 'required|alpha_num',
            'razon_social'                      => 'alpha_num_spaces',
            'base'                              => 'numeric|between:0,9999.99',
            'igv'                               => 'numeric|between:0,9999.99',
            'monto_no_gravado'                  => 'numeric|between:0,9999.99',
            'importe_total'                     => 'numeric|between:0,9999.99',
            'descripcion'                       => 'alpha_num_spaces',

            //'responsable.apellido_paterno'      => 'required|alpha_num',
            //'responsable.apellido_materno'      => 'required|alpha_num',
            //'responsable.nombres'               => 'required|alpha_num'

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
