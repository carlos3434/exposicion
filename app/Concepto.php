<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\ConceptoFilter;
use Illuminate\Database\Eloquent\Builder;
class Concepto extends Model
{
    const GRAVADA = 10;
    const GRATUITA = 11;
    const EXONERADA = 20;
    const INAFECTA = 30;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name','codigo_sunat','unidad_medida','codigo','tipo_afecta_igv','precio','tipo'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('conceptos');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ConceptoFilter($request))->filter($builder);
    }
}
