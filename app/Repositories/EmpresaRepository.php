<?php
namespace App\Repositories;

use App\Empresa;
use App\Http\Resources\Empresa\EmpresaCollection;
use App\Http\Resources\Empresa\Empresa as EmpresaResource;
use App\Http\Requests\Empresa as EmpresaRequest;
use DB;
use App\Repositories\Interfaces\EmpresaRepositoryInterface;
/**
 * 
 */
class EmpresaRepository implements EmpresaRepositoryInterface
{
    public function all($request)
    {
        return new EmpresaCollection(
            Empresa::filter($request)->sort()->paginate()
        );
    }
    public function getOne(Empresa $empresa)
    {
        return new EmpresaResource($empresa);
    }
    public function getById( $empresaId)
    {
        return Empresa::find(1)->first()->toArray();
    }
    public function newOne( $empresa)
    {
        $empresa = Empresa::create($empresa);
        return $empresa->id;
    }
    public function updateOne(EmpresaRequest $request, Empresa $empresa)
    {
        $empresa->update( $request->all() );
        return $empresa;
    }
    public function deleteOne(Empresa $empresa)
    {
        $empresa->delete();
    }
}