<?php
namespace App\Filters\Persona;

class DepartamentoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('departamento_id', $value);
    }
}