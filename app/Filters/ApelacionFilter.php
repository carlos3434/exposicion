<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class ApelacionFilter extends AbstractFilter
{
    protected $filters = [
        'persona_id'     => Common\PeronaFilter::class,
        'documento_id'     => Apelacion\DocumentoFilter::class,//ProcesoDisciplinario
        'fecha_registro'     => Common\FechaRegistroFilter::class,
    ];
}