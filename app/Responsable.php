<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\ResponsableFilter;
use Illuminate\Database\Eloquent\Builder;

class Responsable extends Model
{

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'apellido_paterno',
        'apellido_materno',
        'nombres'
    ];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('responsables');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ResponsableFilter($request))->filter($builder);
    }
}
