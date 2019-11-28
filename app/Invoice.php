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
        'tipo_documento_pago_id',
        'persona_id',
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
        'invoice_id',
        'tipo_nota_id',
        'motivo',
        'is_nota',
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
    public function invoiceDetail()
    {
        return $this->hasMany('App\InvoiceDetail');
    }
    /**
     * Get the tipo_invoice
     */
    public function tipoDocumentoPago()
    {
        return $this->belongsTo('App\TipoDocumentoPago');
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
        return $this->belongsTo('App\Serie');
    }
    /**
     * Get the cliente
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
    /**
     * Get the cliente
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
    /**
     * Get the empresa
     */
    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
    /**
     * Get the empresa
     */
    public function motivoNota()
    {
        return $this->belongsTo('App\TipoNota','tipo_nota_id');
    }
    /**
     * Get the empresa
     */
    public function nota()
    {
        return $this->hasOne('App\Invoice');
    }
    /**
     * Get the empresa
     */
    public function afectado()
    {
        return $this->belongsTo('App\Invoice','invoice_id');
    }
}
