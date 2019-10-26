<?php
namespace App\Filters\Persona;

class RucFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('ruc', $value);
    }
}