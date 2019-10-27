<?php
namespace App\Repositories;

use App\GastoDetail;
use App\Http\Resources\GastoDetail\GastoDetailCollection;
use App\Http\Resources\GastoDetail\GastoDetail as GastoDetailResource;
use App\Http\Requests\GastoDetail as GastoDetailRequest;

use App\Repositories\Interfaces\GastoDetailRepositoryInterface;
/**
 * 
 */
class GastoDetailRepository implements GastoDetailRepositoryInterface
{
    public function all($request)
    {
        return new GastoDetailCollection(
            GastoDetail::filter($request)->sort()->paginate()
        );
    }
    public function getOne(GastoDetail $gastoDetail)
    {
        return new GastoDetailResource($gastoDetail);
    }
    public function newOne( $gastoDetail)
    {
        //search client with dni or ruc
        $gastoDetail = GastoDetail::create($gastoDetail);
        return $gastoDetail->id;
    }
    public function updateOne(GastoDetailRequest $request, GastoDetail $gastoDetail)
    {
        $gastoDetail->update( $request->all() );
        return $gastoDetail;
    }
    public function deleteOne(GastoDetail $gastoDetail)
    {
        $gastoDetail->delete();
    }
}