<?php
namespace App\Repositories;

use App\Pago;
use App\Http\Resources\Pago\PagoCollection;
use App\Http\Resources\Pago\Pago as PagoResource;
use App\Http\Requests\Pago as PagoRequest;
use DB;
use App\Repositories\Interfaces\PagoRepositoryInterface;
/**
 * 
 */
class PagoRepository implements PagoRepositoryInterface
{
    public function all($request)
    {
        return new PagoCollection(
            Pago::filter($request)->sort()->paginate()
        );
    }
    public function getOne(Pago $pago)
    {
        return new PagoResource($pago);
    }
    public function getById( $pagoId)
    {
        return Pago::find(1)->first()->toArray();
    }
    public function newOne( $pago)
    {
        $pago = Pago::create($pago);
        return $pago->id;
    }
    public function updateOne(PagoRequest $request, Pago $pago)
    {
        $pago->update( $request->all() );
        return $pago;
    }
    public function deleteOne(Pago $pago)
    {
        $pago->delete();
    }
    public function updateToComplete( $pagoId , $estadoPagoId)
    {
        $pago = Pago::find( $pagoId );
        $pago->estado_pago_id = $estadoPagoId;
        $pago->save();
    }
}