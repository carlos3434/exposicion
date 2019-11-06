<?php
namespace App\Filters\Inventario;

class EstadoInventarioFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('estado_inventario_id', $value);
    }
}