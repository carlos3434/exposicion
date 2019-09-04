<?php
namespace App\Filters\Persona;

class EspecialidadPosgradoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('especialidad_posgrado_id', $value);
    }
}