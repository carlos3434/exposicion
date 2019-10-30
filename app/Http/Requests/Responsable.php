<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Responsable extends FormRequest
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
            'apellido_paterno' => 'required|alpha_num_spaces',
            'apellido_materno' => 'required|alpha_num_spaces',
            'nombres' => 'required|alpha_num_spaces'
        ];
    }
    public function messages()
    {
        return [
        ];
    }
}
