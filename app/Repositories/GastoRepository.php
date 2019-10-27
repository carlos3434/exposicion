<?php
namespace App\Repositories;

use App\Gasto;
use App\Http\Resources\Gasto\GastoCollection;
use App\Http\Resources\Gasto\Gasto as GastoResource;
use App\Http\Requests\Gasto as GastoRequest;
use Greenter\Model\DocumentInterface;

use App\Repositories\Interfaces\GastoRepositoryInterface;
/**
 * 
 */
class GastoRepository implements GastoRepositoryInterface
{
    public function all($request)
    {
        return new GastoCollection(
            Gasto::filter($request)->sort()->paginate()
        );
    }
    public function getOne(Gasto $gasto)
    {
        return new GastoResource($gasto);
    }
    public function newOne( $gasto)
    {
        //search client with dni or ruc
        return Gasto::create($gasto);
        //return $gasto->id;
    }
    public function updateOne(GastoRequest $request, Gasto $gasto)
    {
        $gasto->update( $request->all() );
        return $gasto;
    }
    public function deleteOne(Gasto $gasto)
    {
        $gasto->delete();
    }
    public function getById($gastoId)
    {
        return new GastoResource(Gasto::find($gastoId));
        //
    }
    public function updatePaths($comprobantePago , DocumentInterface $gasto)
    {
        $comprobantePago = Gasto::find($comprobantePago->id);
        $comprobantePago->xml_path = $gasto->getName().'.xml';
        $comprobantePago->pdf_path = $gasto->getName().'.pdf';
        $comprobantePago->cdr_path = 'R-'.$gasto->getName().'.zip';
        $comprobantePago->save();
        return $comprobantePago;
    }
    public function envioSunat($gastoId)
    {
        $gasto = Gasto::find($gastoId);
        //
    }
}