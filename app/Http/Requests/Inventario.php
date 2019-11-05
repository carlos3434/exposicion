<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Inventario extends FormRequest
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
            'departamento_id'=> 'required',
            'fecha_adquisicion'=> 'required',
            'responsable_id'=> 'required',
            'tipo_inventario_id'=> 'required',
            'codigo'=> 'required',
            'descripcion'=> 'required',
            'cantidad'=> 'required',
            'marca'=> 'required',
            'modelo'=> 'required',
            'serie'=> 'required',
            'caracteristica'=> 'required',
            'ubicacion'=> 'required',
            'vida_util'=> 'required',
            'estado_inventario_id'=> 'required',
            'valor_activo'=> 'required',

            'responsable.apellido_paterno'      => 'required|alpha_num',
            'responsable.apellido_materno'      => 'required|alpha_num',
            'responsable.nombres'               => 'required|alpha_num'
        ];
    }
    public function messages()
    {
        return [
        ];
    }
}
