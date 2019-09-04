<?php
namespace App\Filters\Translado;

class FechaFinFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha_fin) {
                    if (validateDate($fecha_fin)) {
                        $builder->orWhere('fecha_fin', date("Y-m-d", strtotime($fecha_fin)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('fecha_fin', $value);
        }
        return $builder;
    }
}