<?php
namespace App\Filters\Persona;

class DepartamentoColegiadoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('departamento_colegiado_id', $value);
    }
}