<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class IncidenteFilter extends AbstractFilter
{
    protected $filters = [
        'persona'     => Common\PersonaFilter::class,
        'tipo_incidente'     => Incidente\TipoIncidenteFilter::class,
        'fecha_registro'     => Common\FechaRegistroFilter::class,
    ];
}