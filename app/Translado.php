<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
}
