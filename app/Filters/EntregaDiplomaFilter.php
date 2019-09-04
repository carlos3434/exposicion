<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class EntregaDiplomaFilter extends AbstractFilter
{
    protected $filters = [
        'departamento_id'       => Common\DepartamentoFilter::class,
        'fecha_entrega'         => EntregaDiploma\FechaEntregaFilter::class,
    ];
}