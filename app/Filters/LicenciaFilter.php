<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class LicenciaFilter extends AbstractFilter
{
    protected $filters = [
        'persona_id'            => Commmon\PersonaFilter::class,
        'fecha_registro'        => Commmon\FechaRegistroFilter::class,
        'fecha_inicio'          => Licencia\FechaInicioFilter::class,
        'fecha_fin'             => Licencia\FechaFinFilter::class,
    ];
}