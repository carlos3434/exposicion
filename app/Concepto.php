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

    const INSCRIPCION = 1;
    const CUOTA = 2;
    const MULTA = 43;
    const MULTAELECCIONES = 44;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'name','tipo_concepto_id','codigo_sunat','unidad_medida','codigo',
        'tipo_afecta_igv','precio','tipo','plazo_dias','plazo_meses',
        'fraccionable'
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

        $this->setTable('conceptos');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ConceptoFilter($request))->filter($builder);
    }
    /**
     * Get the phone record associated with the user.
     */
    public function pago()
    {
        return $this->hasOne('App\Pago');
    }
}
