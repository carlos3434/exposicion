<?php
namespace App\Filters\Translado;

class OrigenDepartamentoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('origen_departamento_id', $value);
    }
}