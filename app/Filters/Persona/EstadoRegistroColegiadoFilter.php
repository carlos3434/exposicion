<?php
namespace App\Filters\Persona;

class EstadoRegistroColegiadoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('estado_registro_colegiado_id', $value);
    }
}