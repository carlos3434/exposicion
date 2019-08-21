<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcesoDisciplinario extends FormRequest
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
            'fecha_registro' => 'required|date_format:Y-m-d',
            'descripcion' => 'required|alpha_num_spaces',
            'documento' => 'required|alpha_num_spaces',
            'sancion_id' => 'required|exists:sancions,id',
            'tipo_proceso_disciplinario_id' => 'required|exists:tipo_proceso_disciplinarios,id',
            'persona_id' => 'required|integer|min:1',
            //'clave' => 'required|exists:calendarizaciones,clave'
        ];
    }
    public function messages()
    {
        return [
            'fecha_registro.required' => 'El :attribute es un campo requerido',
            'motivo.required' => 'El :attribute es un campo requerido',
            'documento.required' => 'El :attribute es un campo requerido',
            'tipo_proceso_disciplinario_id.required' => 'El :attribute es un campo requerido',
            'tipo_proceso_disciplinario_id.required' => 'El :attribute es un campo requerido',
            'persona_id.required' => 'El :attribute es un campo requerido',
            // ..
        ];
    }
}
