<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class PersonaFilter extends AbstractFilter
{
    protected $filters = [
        'name' => Persona\NameFilter::class
    ];
}