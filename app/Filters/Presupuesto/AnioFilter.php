<?php
namespace App\Filters\Presupuesto;

class AnioFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('email', $value);
    }
}