<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class IncidenteFilter extends AbstractFilter
{
    protected $filters = [
        'persona_id'     => Common\PersonaFilter::class,
        'tipo_incidente_id'     => Incidente\TipoIncidenteFilter::class,
        'fecha_registro'     => Common\FechaRegistroFilter::class,
        'documento'     => Incidente\DocumentoFilter::class,
    ];
}