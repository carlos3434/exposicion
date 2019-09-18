<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Cliente extends FormRequest
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
            'razon_social'                  => 'required|string',
            'direccion'                     => 'required|string',
            'tipo_documento_identidad_id'   => 'required|exists:tipo_documento_identidad,id',
            'numero_documento_identidad'    => 'required|unique:clientes,numero_documento_identidad,'. (isset($this->cliente->id) ? $this->cliente->id : 0),
            'telefono'                      => 'integer',
            'celular'                       => 'integer',
            'email'                         => 'email',
        ];
    }
    public function messages()
    {
        return [
            'razon_social.required' => 'El :attribute es un campo requerido',
            'direccion.required' => 'El :attribute es un campo requerido',
            'tipo_documento_identidad_id.required' => 'El :attribute es un campo requerido',
            'numero_documento_identidad.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
