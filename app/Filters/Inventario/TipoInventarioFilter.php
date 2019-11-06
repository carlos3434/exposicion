<?php
namespace App\Filters\Inventario;

class TipoInventarioFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_inventario_id', $value);
    }
}