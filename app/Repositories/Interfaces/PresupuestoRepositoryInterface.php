<?php

namespace App\Repositories\Interfaces;

use App\Presupuesto;
use App\Http\Resources\Presupuesto\PresupuestoCollection;
use App\Http\Resources\Presupuesto\Presupuesto as PresupuestoResource;
use App\Http\Requests\Presupuesto as PresupuestoRequest;

interface PresupuestoRepositoryInterface
{
    public function all($request);
    public function allForExcel($request);
}