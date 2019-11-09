<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\CajaChicaFilter;
use Illuminate\Database\Eloquent\Builder;

class CajaChica extends Model
{

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'fecha',
        'concepto_id',
        'departamento_id',
        'tipo_documento_pago_id',
        'numero_documento_pago',
        'beneficiario',
        'proveedor',
        'descripcion',
        'monto',
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

        $this->setTable('caja_chica');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new CajaChicaFilter($request))->filter($builder);
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
    public function tipoDocumentoPago()
    {
        return $this->belongsTo('App\TipoDocumentoPago');
    }
    /**
     * Get the Ubigeo
     */
    public function concepto()
    {
        return $this->belongsTo('App\Concepto');
    }
}
