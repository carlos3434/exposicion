<?php
namespace App\Repositories;

use App\Cliente;
use App\Http\Resources\Cliente\ClienteCollection;
use App\Http\Resources\Cliente\Cliente as ClienteResource;

/**
 * 
 */
class ClienteRepository
{
    public function all($request)
    {
        return new ClienteCollection(
            Cliente::filter($request)->sort()->paginate()
        );
    }
    public function getOne($cliente)
    {
        return new ClienteResource($cliente);
    }
    public function newOne($cliente)
    {
        $cliente = Cliente::create($cliente);
        return $cliente;
    }
    public function updateOne($request, $cliente)
    {
        $cliente->update( $request->all() );
        return $cliente;
    }
    public function deleteOne($cliente)
    {
        $cliente->delete();
    }
}