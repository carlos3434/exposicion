<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CajaChica extends FormRequest
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


            'departamento_id'           => 'required|exists:ubigeos,id',
            'tipo_documento_pago_id'    => 'required|exists:tipo_documento_pago,id',
            'concepto_id'               => 'required|exists:conceptos,id',
            'monto'                     => 'numeric|between:0,9999',
            'fecha'                     => 'required|date_format:Y-m-d',
            'numero_documento_pago'     => 'alpha_num_spaces',
            'beneficiario'              => 'alpha_num_spaces',
            'proveedor'                 => 'alpha_num_spaces',
            'descripcion'               => 'alpha_num_spaces',

        ];
    }
    public function messages()
    {
        return [
        ];
    }
}
