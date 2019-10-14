<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\ConceptoPagoFilter;
use Illuminate\Database\Eloquent\Builder;
class ConceptoPago extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name','codigo_sunat','unidad_medida','codigo','tipo_afecta_igv'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('concepto_pago');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ConceptoPagoFilter($request))->filter($builder);
    }
}
