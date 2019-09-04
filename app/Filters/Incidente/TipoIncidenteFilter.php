<?php
namespace App\Filters\Incidente;

class TipoIncidenteFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_incidente_id', $value);
    }
}