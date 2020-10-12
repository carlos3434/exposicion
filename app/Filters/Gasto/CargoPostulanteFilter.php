<?php
namespace App\Filters\Gasto;

class CargoPostulanteFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('cargo_id', $value);
    }
}