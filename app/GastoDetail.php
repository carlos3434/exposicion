<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\GastoDetailFilter;
use Illuminate\Database\Eloquent\Builder;

class GastoDetail extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'gasto_id',
        'tipo_gasto_id',
        'tipo_documento_pago_id',
        'fecha',
        'fecha_fin',
        'detalle',
        'ruc',
        'razon_social',
        'serie',
        'numero',
        'monto',
        'salida',
        'llegada',
        'lugar',
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

        $this->setTable('gasto_detail');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new GastoDetailFilter($request))->filter($builder);
    }

    /**
     * Get the 
     */
    public function tipoGasto()
    {
        return $this->belongsTo('App\ConceptoPago');
    }
    /**
     * Get the 
     */
    public function tipoDocumentoPago()
    {
        return $this->belongsTo('App\TipoDocumentoPago');
    }
}
