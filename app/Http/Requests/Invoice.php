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
            'tipo_documento_pago_id'       => 'required|exists:tipo_documento_pago,id',
            'serie_id'              => 'required|exists:series,id',
            'numero'                => 'string',
            'cliente'               => 'required|json',
            'invoiceDetail'         => 'required|json',
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
        ];

    }
    public function messages()
    {
        return [
            'tipo_documento_pago_id.required' => 'El :attribute es un campo requerido',
            'serie_id.required' => 'El :attribute es un campo requerido',
            'cliente_id.required' => 'El :attribute es un campo requerido',
            'fecha_emision.required' => 'El :attribute es un campo requerido',
            'fecha_vencimiento.required' => 'El :attribute es un campo requerido',
            'empresa_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
