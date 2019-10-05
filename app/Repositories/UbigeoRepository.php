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
    public function getByProvinciaId( $provinciaId)
    {
        return (array) DB::table('ubigeos as dep')
        ->join('ubigeos as dis','dep.id', '=','dis.parent_id')
        ->join('ubigeos as prov','dis.id', '=','prov.parent_id')
        ->select(
            DB::raw('concat(dep.code , dis.code , prov.code ) as ubigeo'),
            'prov.id',
            'dep.name as departamento',
            'dis.name as distrito',
            'prov.name as provincia'
        )
        ->where('prov.id', $provinciaId) // 3967
        ->where('prov.level', 4)
        ->where('dis.level', 3)
        ->where('dep.level', 2)
        ->first();
    }
}