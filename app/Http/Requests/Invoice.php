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
            'tipo_documento_pago_id'                    => 'required|exists:tipo_documento_pago,id',
            'serie_id'                                  => 'required|exists:series,id',
            'numero'                                    => 'string',
            'tipo_moneda'                               => 'required|string',
            'fecha_emision'                             => 'required|date_format:Y-m-d',
            'fecha_vencimiento'                         => 'required|date_format:Y-m-d',
            'tipo_operacion_id'                         => 'exists:tipo_operacion,id',
            'descuento_global'                          => 'numeric|between:0,9999.99',
            'descuento_total'                           => 'numeric|between:0,9999.99',
            //'monto_exogerado'                           => 'numeric|between:0,9999.99',
            //'monto_inafecta'                            => 'numeric|between:0,9999.99',
            //'monto_gravada'                             => 'numeric|between:0,9999.99',
            //'monto_gratuito'                            => 'numeric|between:0,9999.99',
            'igv_total'                                 => 'numeric|between:0,9999.99',
            //'monto_total'                               => 'numeric|between:0,9999.99',
            'valor_venta'                               => 'numeric|between:0,9999.99',
            'monto_importe_total_venta'                 => 'numeric|between:0,9999.99',
            'empresa_id'                                => 'required|exists:empresas,id',

            'cliente.tipo_documento_identidad_id'       => 'required|integer|tipo_documento_identidad',
            'cliente.numero_documento_identidad'        => 'required|integer|numero_documento_identidad',
            'cliente.razon_social'                      => 'required|string',
            'cliente.direccion'                         => 'string',
            'cliente.telefono'                          => 'string',
            'cliente.celular'                           => 'string',
            'cliente.email'                             => 'email',
        ];
        if ($this->request->has('invoiceDetail')) {
            foreach($this->request->get('invoiceDetail') as $key => $val)
            {
                $rules['invoiceDetail.'.$key.'.descripcion']        = 'required|string';
                $rules['invoiceDetail.'.$key.'.precio']             = 'required|numeric|between:0,9999.99';
                $rules['invoiceDetail.'.$key.'.cantidad']           = 'required|integer';
                $rules['invoiceDetail.'.$key.'.descuento_linea']    = 'numeric|between:0,9999.99';
                $rules['invoiceDetail.'.$key.'.concepto_pago_id']   = 'required|exists:conceptos,id';
                $rules['invoiceDetail.'.$key.'.pago_id']   = 'exists:pagos,id';
            }
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
