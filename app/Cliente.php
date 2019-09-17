<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\ClienteFilter;
use Illuminate\Database\Eloquent\Builder;

class Cliente extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['updated_by', 'created_by', 'deleted_by'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('clientes');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ClienteFilter($request))->filter($builder);
    }
    /**
     * Get the 
     */
    public function persona()
    {
        return $this->belongsTo('App\A');
    }
}
