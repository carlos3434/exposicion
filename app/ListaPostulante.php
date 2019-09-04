<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Filters\ListaPostulanteFilter;
use Illuminate\Database\Eloquent\Builder;

class ListaPostulante extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['fecha_registro','lista', 'proceso', 'observacion', 
    'cargo_postulante_id', 'departamento_id','persona_id','updated_by',
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

        $this->setTable('lista_postulantes');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ListaPostulanteFilter($request))->filter($builder);
    }
    /**
     * Get the CargoPostulante
     */
    public function cargoPostulante()
    {
        return $this->belongsTo('App\CargoPostulante', 'cargo_postulante_id');
    }
    /**
     * Get the Ubigeo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Ubigeo', 'departamento_id');
    }
    /**
     * Get the Persona
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }

}
