<?php
namespace App\Repositories;

use App\Ubigeo;
use DB;
use App\Repositories\Interfaces\UbigeoRepositoryInterface;
/**
 * 
 */
class UbigeoRepository implements UbigeoRepositoryInterface
{
    public function getByDistritoId( $distritoId)
    {
        return (array) DB::table('ubigeos as dep')
        ->join('ubigeos as prov','dep.id', '=','prov.parent_id')
        ->join('ubigeos as dis','prov.id', '=','dis.parent_id')
        ->select(
            DB::raw('concat(dep.code  , prov.code , dis.code ) as ubigeo'),
            'dep.name as departamento',
            'dis.name as distrito',
            'prov.name as provincia',
            'dep.id as departamento_id',
            'dis.id as distrito_id',
            'prov.id as provincia_id'
        )
        ->where('dis.id', $distritoId) // 3967 Santiago de Surco
        ->where('dis.level', 4)
        ->where('prov.level', 3)
        ->where('dep.level', 2)
        ->first();
    }
}