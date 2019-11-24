<?php

namespace App\Repositories\Interfaces;

use App\Pago;
use App\Http\Resources\Pago\PagoCollection;
use App\Http\Resources\Pago\Pago as PagoResource;
use App\Http\Requests\Pago as PagoRequest;

interface PagoRepositoryInterface
{
    public function all($request);
    public function getOne(Pago $pago);
    public function getById( $pago);
    public function newOne(PagoRequest $request);
    public function updateOne(PagoRequest $request, Pago $pago);
    public function deleteOne(Pago $pago);
}