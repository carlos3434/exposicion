<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Filters\UbigeoFilter;
use Illuminate\Database\Eloquent\Builder;

class Ubigeo extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name','code', 'label', 'search', 'number_children', 'level','id_parent'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('ubigeos');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new UbigeoFilter($request))->filter($builder);
    }
}
