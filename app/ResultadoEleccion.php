<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Filters\ResultadoEleccionFilter;
use Illuminate\Database\Eloquent\Builder;

class ResultadoEleccion extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['fecha_registro','lista_ganadora', 'numero_votantes', 'numero_novotantes', 
    'numero_votos', 'observacion','departamento_id','updated_by',
    'created_by','deleted_by'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('resultado_eleccions');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ResultadoEleccionFilter($request))->filter($builder);
    }
    /**
     * Get the Ubigeo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Ubigeo', 'departamento_id');
    }
}
