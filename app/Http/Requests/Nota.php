<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Nota extends FormRequest
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

            'invoice_id'                => 'required|exists:invoices,id',
            'tipo_nota_id'              => 'required|exists:tipo_notas,id',
            'motivo'                    => 'required|alpha_num_spaces'

        ];
    }
    public function messages()
    {
        return [
            'ruc.required' => 'El :attribute es un campo requerido',
            'nombre_comercial.required' => 'El :attribute es un campo requerido',
            'razon_social.required' => 'El :attribute es un campo requerido',
            'direccion_web.required' => 'El :attribute es un campo requerido',
            'telefono.required' => 'El :attribute es un campo requerido',
            'direccion.required' => 'El :attribute es un campo requerido',
            'ubigeo_id.required' => 'El :attribute es un campo requerido',
            
            // ..
        ];
    }
}
