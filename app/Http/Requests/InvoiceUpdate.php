<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdate extends FormRequest
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
            //'tipo_moneda'                               => 'required|string',
            'fecha_emision'                             => 'required|date_format:Y-m-d',
            'fecha_vencimiento'                         => 'required|date_format:Y-m-d',
            //'tipo_operacion_id'                         => 'exists:tipo_operacion,id',
            'descuento_global'                          => 'numeric|between:0,9999.99',
            'descuento_total'                           => 'numeric|between:0,9999.99',
            'igv_total'                                 => 'numeric|between:0,9999.99',
            'valor_venta'                               => 'numeric|between:0,9999.99',
            'monto_importe_total_venta'                 => 'numeric|between:0,9999.99',
            'invoiceDetail'                           => 'required|array'
        ];
        if ($this->request->has('invoiceDetail') && is_array($this->request->get('invoiceDetail')) ) {
            foreach($this->request->get('invoiceDetail') as $key => $val)
            {
                $rules['invoiceDetail.'.$key.'.id']                 = 'required|exists:invoice_detail,id';
                $rules['invoiceDetail.'.$key.'.descripcion']        = 'required|string';
                $rules['invoiceDetail.'.$key.'.precio']             = 'required|numeric|between:0,9999.99';
                $rules['invoiceDetail.'.$key.'.cantidad']           = 'required|integer|between:1,99';
                $rules['invoiceDetail.'.$key.'.descuento_linea']    = 'required|numeric|between:0,9999.99';
                $rules['invoiceDetail.'.$key.'.concepto_pago_id']   = 'required|exists:conceptos,id';
                $rules['invoiceDetail.'.$key.'.pago_id']            = 'exists:pagos,id';
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
