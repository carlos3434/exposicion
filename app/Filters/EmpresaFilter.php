<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class EmpresaFilter extends AbstractFilter
{
    protected $filters = [
        'ruc'           => Empresa\RucFilter::class
    ];
}