<?php
namespace App\Filters\Persona;

class ProvinciaFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('provincia_id', $value);
    }
}