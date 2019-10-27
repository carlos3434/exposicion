<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Gasto extends FormRequest
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

            'motivo'                    => 'string',
            'origen'                    => 'string',
            'destino'                   => 'string',
            'retorno'                   => 'string',
            'fecha_salida'              => 'required|date_format:Y-m-d',
            'fecha_retorno'             => 'required|date_format:Y-m-d',
            'monto_recibido'            => 'numeric|between:0,9999.99',
            'monto_retenido'            => 'numeric|between:0,9999.99',
            'devolucion'                => 'numeric|between:0,9999.99',
            'pendiente_rendicion'       => 'numeric|between:0,9999.99',
            'total'                     => 'numeric|between:0,9999.99',
            'fecha_registro'            => 'required|date_format:Y-m-d',

            'persona_id'                => 'required|exists:personas,id',
            'cargo_id'                  => 'required|exists:cargo_postulantes,id',
            'departamento_id'           => 'required|exists:ubigeos,id',

        ];
        if ($this->request->has('gastoDetail')) {
            foreach($this->request->get('gastoDetail') as $key => $val)
            {
                $rules['invoiceDetail.'.$key.'.descripcion']        = 'required|string';
                $rules['invoiceDetail.'.$key.'.descripcion']        = 'required|string';
                $rules['invoiceDetail.'.$key.'.descripcion']        = 'required|string';
                $rules['invoiceDetail.'.$key.'.descripcion']        = 'required|string';
                $rules['invoiceDetail.'.$key.'.precio']             = 'required|numeric|between:0,9999.99';
                $rules['invoiceDetail.'.$key.'.cantidad']           = 'required|integer';
                $rules['invoiceDetail.'.$key.'.descuento_linea']    = 'numeric|between:0,9999.99';
                $rules['invoiceDetail.'.$key.'.concepto_pago_id']   = 'required|exists:concepto_pago,id';
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
