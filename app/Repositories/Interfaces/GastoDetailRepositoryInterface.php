<?php

namespace App\Repositories\Interfaces;

use App\GastoDetail;
use App\Http\Resources\GastoDetail\GastoDetailCollection;
use App\Http\Resources\GastoDetail\GastoDetail as GastoDetailResource;
use App\Http\Requests\GastoDetail as GastoDetailRequest;

interface GastoDetailRepositoryInterface
{
    public function all($request);
    public function getOne(GastoDetail $gastoDetail);
    public function newOne(GastoDetailRequest $request);
    public function updateOne(GastoDetailRequest $request, GastoDetail $gastoDetail);
    public function deleteOne(GastoDetail $gastoDetail);
}