<?php
namespace App\Filters\Rendicion;

class PeriodoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('periodo', $value);
    }
}