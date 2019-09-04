<?php
namespace App\Filters\Persona;

class NacionalidadFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('nacionalidad_id', $value);
    }
}