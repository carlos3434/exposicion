<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Filters\ProcesoDisciplinarioFilter;
use Illuminate\Database\Eloquent\Builder;

class ProcesoDisciplinario extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['fecha_registro', 'descripcion', 'documento', 
    'persona_id','updated_by', 'created_by',
    'deleted_by','sancion_id','is_apelacion','tipo_proceso_disciplinario_id'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('proceso_disciplinarios');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ProcesoDisciplinarioFilter($request))->filter($builder);
    }
    /**
     * Get the Persona
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
    /**
     * Get the Sancion
     */
    public function sancion()
    {
        return $this->belongsTo('App\Sancion');
    }
    /**
     * Get the Persona
     */
    public function tipoProcesoDisciplinario()
    {
        return $this->belongsTo('App\TipoProcesoDisciplinario','tipo_proceso_disciplinario_id');
    }
}
