<?php
namespace App\Filters\ProcesoDisciplinario;

class SancionFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('sancion_id', $value);
    }
}