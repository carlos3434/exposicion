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
        $rules = [
            //'tipo_invoice_id'       => 'required|exists:tipo_invoice,id',
            'tipo_documento_pago_id'       => 'required|exists:tipo_documento_pago,id',
            'serie_id'              => 'required|exists:series,id',
            'numero'                => 'string',
            //'cliente_id'            => 'required|exists:clientes,id',

            'cliente.tipo_documento_identidad_id'        => 'required|integer',
            'cliente.numero_documento_identidad'         => 'required|integer',
            'cliente.razon_social'                       => 'required|string',
            'cliente.direccion'                          => 'string',
            'cliente.telefono'                           => 'string',
            'cliente.celular'                            => 'string',
            'cliente.email'                              => 'email',

            //cliente[tipo_documento_identidad_id]

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

        foreach($this->request->get('invoiceDetail') as $key => $val)
        {
            $rules['invoiceDetail.'.$key.'.descripcion'] = 'required|string';
            $rules['invoiceDetail.'.$key.'.precio'] = 'required|string';
            $rules['invoiceDetail.'.$key.'.cantidad'] = 'required|integer';
            $rules['invoiceDetail.'.$key.'.descuento_linea'] = 'integer';
            $rules['invoiceDetail.'.$key.'.concepto_pago_id'] = 'required|exists:concepto_pago,id';
        }

        return $rules;


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
