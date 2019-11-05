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

            'departamento_id'                   => 'required|exists:ubigeos,id',
            'fecha_adquisicion'                 => 'date_format:Y-m-d',
            'tipo_inventario_id'                => 'required|exists:tipo_inventario,id',
            'codigo'                            => 'alpha_num_spaces',
            'descripcion'                       => 'alpha_num_spaces',
            'cantidad'                          => 'required|numeric|between:0,9999',
            'marca'                             => 'required',
            'modelo'                            => 'required',
            'serie'                             => 'required',
            'caracteristica'                    => 'alpha_num_spaces',
            'ubicacion'                         => 'alpha_num_spaces',
            'vida_util'                         => 'alpha_num_spaces',
            'estado_inventario_id'              => 'required|exists:estado_inventario,id',
            'valor_activo'                      => 'alpha_num_spaces',

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
