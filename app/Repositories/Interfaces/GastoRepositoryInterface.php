<?php

namespace App\Repositories\Interfaces;

use App\Gasto;
use App\Http\Resources\Gasto\GastoCollection;
use App\Http\Resources\Gasto\Gasto as GastoResource;
use App\Http\Requests\Gasto as GastoRequest;

interface GastoRepositoryInterface
{
    public function all($request);
    public function getOne(Gasto $gasto);
    public function newOne(GastoRequest $request);
    public function updateOne(GastoRequest $request, Gasto $gasto);
    public function deleteOne(Gasto $gasto);

    public function getById($gastoId);
    public function envioSunat($gastoId);
}