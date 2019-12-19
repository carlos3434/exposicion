<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\InventarioFilter;
use Illuminate\Database\Eloquent\Builder;

class Inventario extends Model
{

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'departamento_id',
        'fecha_adquisicion',
        'responsable_id',
        'tipo_inventario_id',
        'codigo',
        'descripcion',
        'cantidad',
        'marca',
        'modelo',
        'serie',
        'caracteristica',
        'ubicacion',
        'vida_util',
        'estado_inventario_id',
        'valor_activo',
        'partida_registral'
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

        $this->setTable('inventarios');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new InventarioFilter($request))->filter($builder);
    }
    /**
     * Get the Responsable
     */
    public function departamento()
    {
        return $this->belongsTo('App\Ubigeo','departamento_id');
    }
    /**
     * Get the Responsable
     */
    public function responsable()
    {
        return $this->belongsTo('App\Responsable');
    }
    /**
     * Get the TipoInventario
     */
    public function tipoInventario()
    {
        return $this->belongsTo('App\TipoInventario');
    }
    /**
     * Get the EstadoInventario
     */
    public function estadoInventario()
    {
        return $this->belongsTo('App\EstadoInventario');
    }
}
