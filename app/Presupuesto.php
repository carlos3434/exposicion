<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\PresupuestoFilter;
use Illuminate\Database\Eloquent\Builder;

class Presupuesto extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'departamento_id',
        'tipo_presupuesto_id',
        'concepto_id',
        'monto',
        'mes'
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

        $this->setTable('presupuestos');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new PresupuestoFilter($request))->filter($builder);
    }
    /**
     * Get the Ubigeo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Ubigeo', 'departamento_id');
    }
    /**
     * Get the Ubigeo
     */
    public function tipoPresupuesto()
    {
        return $this->belongsTo('App\TipoPresupuesto');
    }
    /**
     * Get the Ubigeo
     */
    public function concepto()
    {
        return $this->belongsTo('App\Concepto');
    }
}
