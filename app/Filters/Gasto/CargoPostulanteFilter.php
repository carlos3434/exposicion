<?php
namespace App\Filters\Gasto;

class CargoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('cargo_id', $value);
    }
}