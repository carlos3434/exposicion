<?php
namespace App\Filters\Persona;

class NumeroCMVPFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('numero_cmvp', $value);
    }
}