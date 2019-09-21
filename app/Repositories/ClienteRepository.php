<?php
namespace App\Repositories;

use App\Cliente;
use App\Http\Resources\Cliente\ClienteCollection;
use App\Http\Resources\Cliente\Cliente as ClienteResource;
use App\Http\Requests\Cliente as ClienteRequest;

use App\Repositories\Interfaces\ClienteRepositoryInterface;
/**
 * 
 */
class ClienteRepository implements ClienteRepositoryInterface
{
    public function all($request)
    {
        return new ClienteCollection(
            Cliente::filter($request)->sort()->paginate()
        );
    }
    public function getOne(Cliente $cliente)
    {
        return new ClienteResource($cliente);
    }
    public function getByDni( $cliente)
    {
        return Cliente::firstOrCreate($cliente);
        return Cliente::where('tipo_documento_identidad_id',$cliente['tipo_documento_identidad_id'])
        ->where('numero_documento_identidad',$cliente['numero_documento_identidad'])
        ->first();
        //return Cliente::filter($cliente);
    }
    public function newOne( $cliente)
    {
        //search client with dni or ruc
        $cliente = Cliente::create($cliente);
        return $cliente->id;
    }
    public function updateOne(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update( $request->all() );
        return $cliente;
    }
    public function deleteOne(Cliente $cliente)
    {
        $cliente->delete();
    }
}