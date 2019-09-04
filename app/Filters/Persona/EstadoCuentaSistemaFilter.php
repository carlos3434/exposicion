<?php
namespace App\Filters\Persona;

class EstadoCuentaSistemaFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('estado_cuenta_sistema_id', $value);
    }
}