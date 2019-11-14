<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\PagoFilter;
use Illuminate\Database\Eloquent\Builder;

class Pago extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'monto',
        'numero_fraccion',
        'is_fraccion',
        'fecha_vencimiento',
        'estado_pago_id',
        'concepto_id',
        'persona_id',
        'pago_id',
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

        $this->setTable('pagos');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new PagoFilter($request))->filter($builder);
    }
    /**
     * Get the Persona
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
    /**
     * Get the Persona
     */
    public function concepto()
    {
        return $this->belongsTo('App\Concepto');
    }
    /**
     * Get the Persona
     */
    public function estadoPago()
    {
        return $this->belongsTo('App\EstadoPago');
    }
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
    public function childrenPagos()
    {
        return $this->hasMany(Pago::class)->with('pagos');
    }
}
