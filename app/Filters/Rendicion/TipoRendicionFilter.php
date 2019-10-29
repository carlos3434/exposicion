<?php
namespace App\Filters\Rendicion;

class TipoRendicionFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_rendicion_id', $value);
    }
}