<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\InvoiceFilter;
use Illuminate\Database\Eloquent\Builder;

class Invoice extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_invoice_id',
        'serie_id',
        'numero',
        'cliente_id',
        'tipo_moneda',
        'fecha_emision',
        'fecha_vencimiento',
        'tipo_operacion_id',
        'descuento_global',
        'descuento_total',
        'monto_exogerado',
        'monto_inafecta',
        'monto_gravada',
        'monto_gratuito',
        'igv_total',
        'monto_total',
        'empresa_id',
        'updated_by', 'created_by', 'deleted_by'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('invoices');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new InvoiceFilter($request))->filter($builder);
    }
    /**
     * Get the tipo_invoice
     */
    public function tipoInvoice()
    {
        return $this->belongsTo('App\TipoInvoice');
    }
    /**
     * Get the TipoOperacion
     */
    public function tipoOperacion()
    {
        return $this->belongsTo('App\TipoOperacion');
    }
    /**
     * Get the serie
     */
    public function serie()
    {
        return $this->belongsTo('App\Seire');
    }
    /**
     * Get the cliente
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
    /**
     * Get the empresa
     */
    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
}