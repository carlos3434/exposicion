<?php
namespace App\Filters\Pago;

class IsFraccionFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('is_fraccion', $value);
    }
}