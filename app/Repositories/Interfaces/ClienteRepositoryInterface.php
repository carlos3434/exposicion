<?php

namespace App\Repositories\Interfaces;

use App\Cliente;
use App\Http\Resources\Cliente\ClienteCollection;
use App\Http\Resources\Cliente\Cliente as ClienteResource;
use App\Http\Requests\Cliente as ClienteRequest;

interface ClienteRepositoryInterface
{
    public function all($request);
    public function getOne(Cliente $cliente);
    public function getByDni( $cliente);
    public function newOne(ClienteRequest $request);
    public function updateOne(ClienteRequest $request, Cliente $cliente);
    public function deleteOne(Cliente $cliente);
}