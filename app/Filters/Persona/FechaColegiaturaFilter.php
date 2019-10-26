<?php
namespace App\Filters\Persona;

class FechaColegiaturaFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha_colegiatura) {
                    if (validateDate($fecha_colegiatura)) {
                        $builder->orWhere('fecha_colegiatura', date("Y-m-d", strtotime($fecha_colegiatura)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('fecha_colegiatura', $value);
        }
        return $builder;
    }
}