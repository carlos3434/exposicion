<?php
namespace App\Filters\Persona;

class UniversidadProcedenciaFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('universidad_procedencia_id', $value);
    }
}