<?php

namespace App\Http\Resources\ProcesoDisciplinario;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcesoDisciplinarioExcel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //[ "id","fecha_registro", "descripcion", "documento", "sancion_id" , "tipo_proceso_disciplinario_id", "persona_id","created_at"];
            
        return [
            'id'                            => $this->id,
            'fecha_registro'                => $this->fecha_registro,
            'descripcion'                   => $this->descripcion,
            'documento'                     => $this->documento,
            'fecha_inicio'                  => $this->fecha_inicio,
            'fecha_fin'                     => $this->fecha_fin,
            'monto_multa'                   => $this->monto_multa,
            'sancion'                       => isset( $this->sancion->name) ? $this->sancion->name : '',
            'is_apelacion'                  => $this->is_apelacion,
            'tipo_proceso_disciplinario'    => isset( $this->tipoProcesoDisciplinario->name) ? $this->tipoProcesoDisciplinario->name : '',
            'persona'                       => isset( $this->persona->full_name) ? $this->persona->full_name : '',

            'created_at'                    => $this->created_at->toDateTimeString(),

        ];
    }
}
