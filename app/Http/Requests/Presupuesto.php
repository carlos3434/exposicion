<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Presupuesto extends FormRequest
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

            'departamento_id'       => 'required|exists:ubigeos,id',
            'tipo_presupuesto_id'   => 'required|exists:tipo_presupuesto,id',
            'concepto_id'           => 'required|exists:conceptos,id',
            'monto'                 => 'numeric|between:0,9999',
            'mes'                   => 'required|date_format:Y-m-d'

        ];
    }
    public function messages()
    {
        return [
        ];
    }
}
