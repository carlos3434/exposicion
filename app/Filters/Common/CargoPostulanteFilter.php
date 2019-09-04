<?php
namespace App\Filters\Common;

class CargoPostulanteFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('cargo_postulante_id', $value);
    }
}