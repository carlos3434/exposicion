<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class PresupuestoFilter extends AbstractFilter
{
    protected $filters = [
        'anio' => Presupuesto\AnioFilter::class,
        'departamento_id' => Common\DepartamentoFilter::class,
    ];
}