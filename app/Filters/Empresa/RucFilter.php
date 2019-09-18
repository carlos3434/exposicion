<?php
namespace App\Filters\Empresa;

class RucFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('ruc', $value);
    }
}