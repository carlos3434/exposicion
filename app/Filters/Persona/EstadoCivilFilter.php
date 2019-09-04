<?php
namespace App\Filters\Persona;

class EstadoCivilFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('estado_civil_id', $value);
    }
}