<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Filters\UbigeoFilter;
use Illuminate\Database\Eloquent\Builder;

class Ubigeo extends Model
{
    const PERU = 2533;
    const AMAZONAS = 2534;
    const ANCASH = 2625;
    const APURIMAC = 2812;
    const AREQUIPA = 2900;
    const AYACUCHO = 3020;
    const CAJAMARCA = 3143;
    const CUSCO = 3292;
    const HUANCAVELICA = 3414;
    const HUANUCO = 3518;
    const ICA = 3606;
    const JUNIN = 3655;
    const LALIBERTAD = 3788;
    const LAMBAYEQUE = 3884;
    const LIMA = 3926;
    const LORETO = 4108;
    const MADREDEDIOS = 4165;
    const MOQUEGUA = 4180;
    const PASCO = 4204;
    const PIURA = 4236;
    const PUNO = 4309;
    const SANMARTIN = 4431;
    const TACNA = 4519;
    const TUMBES = 4551;
    const UCAYALI = 4567;

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name','code', 'label', 'search', 'number_children', 'level','id_parent'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('ubigeos');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new UbigeoFilter($request))->filter($builder);
    }
}
