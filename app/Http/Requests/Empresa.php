<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Empresa extends FormRequest
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

            'ruc'                       => 'required|digits:11|unique:empresas,ruc,'. (isset($this->empresa->id) ? $this->empresa->id : 0),

            'nombre_comercial'          => 'required|string',
            'certificado_digital'       => 'file|max:2048',
            'razon_social'              => 'required|string',
            'direccion_web'             => 'required|url',
            'telefono'                  => 'required|integer',
            'email'                     => 'email',
            'direccion'                 => 'required|string',
            'logo'                      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ubigeo_id'                 => 'required|exists:ubigeos,id',
            'user_sunat'                => 'string',
            //'password_sunat'            => 'string',
            'entorno'                   => 'in:0,1',

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
