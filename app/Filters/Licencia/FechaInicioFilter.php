<?php
namespace App\Filters\Licencia;

class FechaInicioFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha_inicio) {
                    if (validateDate($fecha_inicio)) {
                        $builder->orWhere('fecha_inicio', date("Y-m-d", strtotime($fecha_inicio)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('fecha_inicio', $value);
        }
        return $builder;
    }
}