<?php
namespace App\Filters\Persona;

class UbigeoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('ubigeo_id', $value);
    }
}