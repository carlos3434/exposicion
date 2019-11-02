<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\RendicionFilter;
use Illuminate\Database\Eloquent\Builder;

class Rendicion extends Model
{

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'periodo',
        'tipo_rendicion_id',
        'fecha',
        'tipo_documento_pago_id',
        'serie',
        'numero',
        'tipo_documento_identidad_id',
        'departamento_id',
        'responsable_id',
        'numero_documento_identidad',
        'razon_social',
        'base',
        'igv',
        'monto_no_gravado',
        'importe_total',
        'descripcion'
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

        $this->setTable('rendicions');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new RendicionFilter($request))->filter($builder);
    }
    /**
     * Get the TipoDocumentoIdentidad
     */
    public function tipoDocumentoIdentidad()
    {
        return $this->belongsTo('App\TipoDocumentoIdentidad');
    }
    /**
     * Get the TipoDocumentoIdentidad
     */
    public function tipoRendicion()
    {
        return $this->belongsTo('App\TipoRendicion');
    }
    /**
     * Get the TipoDocumentoIdentidad
     */
    public function tipoDocumentoPago()
    {
        return $this->belongsTo('App\TipoDocumentoPago');
    }
    /**
     * Get the Responsable
     */
    public function responsable()
    {
        return $this->belongsTo('App\Responsable');
    }
    /**
     * Get the departamento
     */
    public function departamento()
    {
        return $this->belongsTo('App\Ubigeo','departamento_id');
    }
}
