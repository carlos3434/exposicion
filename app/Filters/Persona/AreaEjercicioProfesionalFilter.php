<?php
namespace App\Filters\Persona;

class AreaEjercicioProfesionalFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('area_ejercicio_profesional_id', $value);
    }
}