<?php
namespace App\Filters\Persona;

class DistritoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('distrito_id', $value);
    }
}