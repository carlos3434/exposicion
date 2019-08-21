<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class UbigeoFilter extends AbstractFilter
{
    protected $filters = [
        'level'     => Ubigeo\LevelFilter::class,
        'parent_id'  => Ubigeo\ParentFilter::class,
        'search'  => Ubigeo\SearchFilter::class,
    ];
}