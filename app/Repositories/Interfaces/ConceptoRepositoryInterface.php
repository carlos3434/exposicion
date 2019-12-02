<?php

namespace App\Repositories\Interfaces;

use App\Concepto;
use App\Http\Resources\Concepto\ConceptoCollection;
use App\Http\Resources\Concepto\Concepto as ConceptoResource;
use App\Http\Requests\Concepto as ConceptoRequest;

interface ConceptoRepositoryInterface
{
    public function getIngresos();
    public function getEgresosByTipo($tipo);
}