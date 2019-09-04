<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Filters\TransladoFilter;
use Illuminate\Database\Eloquent\Builder;

class Translado extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['fecha_registro', 'motivo', 'documento', 
    'origen_departamento_id','destino_departamento_id', 'persona_id',
    'created_by','updated_by','deleted_by'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('translados');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new TransladoFilter($request))->filter($builder);
    }
    /**
     * Get the TipoDocumentoIdentidad
     */
    public function origenDepartamento()
    {
        return $this->belongsTo('App\Ubigeo');
    }
    /**
     * Get the Ubigeo
     */
    public function destinoDepartamento()
    {
        return $this->belongsTo('App\Ubigeo');
    }
    /**
     * Get the EstadoCivil
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
}
