<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class ClienteFilter extends AbstractFilter
{
    protected $filters = [
        'departamento_id'   => Common\DepartamentoFilter::class,
        'fecha_registro'    => Common\FechaRegistroFilter::class,
    ];
}