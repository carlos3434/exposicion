<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Role extends FormRequest
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

            'name' => 'required|alpha_num_spaces|unique:roles,name,'. (isset($this->id) ? $this->id : 0),
            'slug' => 'alpha_dash|unique:roles,slug',
            'description' => 'required|alpha_num_spaces',
            'special' => 'in:all-access',
            'permissions' => 'exists:permissions,id'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El :attribute es un campo requerido',
            'name.alpha_num_spaces' => 'El :attribute solo puede contener caracteres alfanumericos, espacios, guin bajo y guines',
            'name.unique' => 'El :attribute ya ha sido tomado',
            'slug.alpha_dash' => 'El :attribute puede solo contener letras, numeros, guiones y suiones bajo.',
            'slug.unique' => 'El :attribute ya ha sido tomado',
            'description.required' => 'El :attribute es un campo requerido',
            'description.alpha_num_spaces' => 'El :attribute solo puede contener caracteres alfanumericos, espacios, guin bajo y guines',
            'permissions.exists' => 'El :attribute seleccionado es invalido',
            'special.in' => 'El valor de :attribute es invalido'
            // ..
        ];
    }
}
