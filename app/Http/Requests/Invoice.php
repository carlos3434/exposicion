<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Invoice extends FormRequest
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
            'tipo_invoice_id'       => 'required|exists:tipo_invoice,id',
            'serie_id'              => 'required|exists:series,id',
            'numero'                => 'string',
            //'cliente_id'            => 'required|exists:clientes,id',
            /*'cliente_tipo_documento_identidad_id'        => 'required|integer',
            'cliente_numero_documento_identidad'         => 'required|integer',
            'cliente_razon_social'                       => 'required|string',
            'cliente_direccion'                          => 'string',
            'cliente_telefono'                           => 'string',
            'cliente_celular'                            => 'string',
            'cliente_email'                              => 'email',*/

            'tipo_moneda'           => 'required|string',
            'fecha_emision'         => 'required|date_format:Y-m-d',
            'fecha_vencimiento'     => 'required|date_format:Y-m-d',
            'tipo_operacion_id'     => 'exists:tipo_operacion,id',
            'descuento_global'      => 'numeric',
            'descuento_total'       => 'numeric',
            'monto_exogerado'       => 'numeric',
            'monto_inafecta'        => 'numeric',
            'monto_gravada'         => 'numeric',
            'monto_gratuito'        => 'numeric',
            'igv_total'             => 'numeric',
            'monto_total'           => 'numeric',
            'empresa_id'            => 'required|exists:empresas,id',

            //'clave' => 'required|exists:calendarizaciones,clave'
        ];
    }
    public function messages()
    {
        return [
            'tipo_invoice_id.required' => 'El :attribute es un campo requerido',
            'serie_id.required' => 'El :attribute es un campo requerido',
            'cliente_id.required' => 'El :attribute es un campo requerido',
            'fecha_emision.required' => 'El :attribute es un campo requerido',
            'fecha_vencimiento.required' => 'El :attribute es un campo requerido',
            'empresa_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
