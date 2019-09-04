<?php
namespace App\Filters\Common;

class DepartamentoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('departamento_id', $value);
    }
}