<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Concepto extends FormRequest
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
            'name'              => 'required|alpha_num_spaces',
            //'codigo_sunat'      => 'alpha_num_spaces',
            'unidad_medida'     => 'required_if:tipo,0|alpha_num_spaces',
            'codigo'            => 'required|alpha_num_spaces',
            'tipo_afecta_igv'   => 'required_if:tipo,0|in:10,11,20,30',
            'precio'            => 'required|numeric|between:0,9999',
            'tipo'              => 'required|boolean',
            'plazo_dias'        => 'numeric|between:0,99',
            'plazo_meses'       => 'numeric|between:0,99'
        ];
    }
    public function messages()
    {
        return [
            // ..
        ];
    }
}
