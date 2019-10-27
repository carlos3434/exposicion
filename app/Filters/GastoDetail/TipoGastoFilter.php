<?php
namespace App\Filters\Gasto;

class TipoGastoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_gasto_id', $value);
    }
}