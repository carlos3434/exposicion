<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    protected $filters = [
        'name' => User\NameFilter::class,
        'email' => User\EmailFilter::class,
    ];
}