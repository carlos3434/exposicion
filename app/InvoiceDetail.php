<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\InvoiceDetailFilter;
use Illuminate\Database\Eloquent\Builder;
class InvoiceDetail extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['fecha_registro'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('invoice_detail');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new InvoiceDetailFilter($request))->filter($builder);
    }
    /**
     * Get the Persona
     */
    public function persona()
    {
        return $this->belongsTo('App\A');
    }
}
