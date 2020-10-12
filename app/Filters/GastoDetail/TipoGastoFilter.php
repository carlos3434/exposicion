<?php
namespace App\Filters\GastoDetail;

class TipoGastoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_gasto_id', $value);
    }
}