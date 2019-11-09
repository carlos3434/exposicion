<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class CajaChicaFilter extends AbstractFilter
{
    protected $filters = [
        'departamento_id' => Common\DepartamentoFilter::class,
    ];
}