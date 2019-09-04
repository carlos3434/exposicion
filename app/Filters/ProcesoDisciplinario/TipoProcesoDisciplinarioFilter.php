<?php
namespace App\Filters\ProcesoDisciplinario;

class TipoProcesoDisciplinarioFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_proceso_disciplinario_id', $value);
    }
}