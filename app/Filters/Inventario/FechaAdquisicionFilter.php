<?php
namespace App\Filters\Inventario;

class FechaAdquisicionFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha_adquisicion) {
                    if (validateDate($fecha_adquisicion)) {
                        $builder->orWhere('fecha_adquisicion', date("Y-m-d", strtotime($fecha_adquisicion)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('fecha_adquisicion', $value);
        }
        return $builder;
    }
}