<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoIncidente extends FormRequest
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
            'name' => 'required|alpha_num_spaces'
            //'clave' => 'required|exists:calendarizaciones,clave'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El :attribute es un campo requerido',
            'name.alpha_num' => 'El :attribute debe solo contener numeros y letras'
            // ..
        ];
    }
}
