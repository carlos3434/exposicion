<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class ProcesoDisciplinarioFilter extends AbstractFilter
{
    protected $filters = [
        'persona_id'            => Common\PersonaFilter::class,
        'sancion_id'            => ProcesoDisciplinario\SancionFilter::class,
        'tipo_proceso_disciplinario_id'     => ProcesoDisciplinario\TipoProcesoDisciplinarioFilter::class,
        'fecha_registro'        => Common\FechaRegistroFilter::class,
    ];
}