<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\TipoNotaFilter;
use Illuminate\Database\Eloquent\Builder;

class TipoNota extends Model
{
    const NOTACREDITO = 0;
    const NOTADEBITO = 1;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name','codigo','codigo_sunat','tipo'];
    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('tipo_notas');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new TipoNotaFilter($request))->filter($builder);
    }
}
