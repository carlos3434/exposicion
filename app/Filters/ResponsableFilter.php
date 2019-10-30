<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class ResponsableFilter extends AbstractFilter
{
    protected $filters = [
        'full_name'     => Responsable\FullNameFilter::class,
    ];
}