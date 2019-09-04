<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Filters\EntregaDiplomaFilter;
use Illuminate\Database\Eloquent\Builder;

class EntregaDiploma extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['departamento_id', 'fecha_entrega', 'cantidad','observacion'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('entrega_diplomas');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new EntregaDiplomaFilter($request))->filter($builder);
    }
    /**
     * Get the Ubigeo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Ubigeo','departamento_id');
    }
}
