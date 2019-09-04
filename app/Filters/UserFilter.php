<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class UserFilter extends AbstractFilter
{
    protected $filters = [
        'name' => User\NameFilter::class,
        'email' => User\EmailFilter::class,
    ];
}