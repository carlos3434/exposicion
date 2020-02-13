<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Filters\SerieFilter;
use Illuminate\Database\Eloquent\Builder;

class Serie extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('series');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new SerieFilter($request))->filter($builder);
    }
    /**
     * Get the 
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }

    public function departamento()
    {
        return $this->hasOne('App\Ubigeo', 'id', 'departamento_id');
    }
}
