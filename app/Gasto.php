<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\GastoFilter;
use Illuminate\Database\Eloquent\Builder;

class Gasto extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'motivo',
        'origen',
        'destino',
        'retorno',
        'fecha_salida',
        'fecha_retorno',
        'monto_recibido',
        'monto_retenido',
        'devolucion',
        'pendiente_rendicion',
        'total',
        'fecha_registro',
        'persona_id',
        'cargo_id',
        'departamento_id',
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

        $this->setTable('gastos');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new GastoFilter($request))->filter($builder);
    }
    /**
     * Get the tipo_invoice
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
    /**
     * Get the tipo_invoice
     */
    public function cargo()
    {
        return $this->belongsTo('App\CargoPostulante');
    }
    /**
     * Get the TipoOperacion
     */
    public function departamento()
    {
        return $this->belongsTo('App\Ubigeo','departamento_id');
    }
}
