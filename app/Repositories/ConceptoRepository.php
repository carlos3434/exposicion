<?php
namespace App\Repositories;

use App\Concepto;
use App\Http\Resources\Concepto\ConceptoCollection;
use App\Http\Resources\Concepto\Concepto as ConceptoResource;
use App\Http\Requests\Concepto as ConceptoRequest;

use App\Repositories\Interfaces\ConceptoRepositoryInterface;
/**
 * 
 */
class ConceptoRepository implements ConceptoRepositoryInterface
{
    public function getIngresos()
    {
        return new ConceptoCollection(
            Concepto::where('tipo', 0)->get()
        );
    }
    public function getEgresosByTipo($tipoConceptoId)
    {
        return new ConceptoCollection(
            Concepto::where('tipo_concepto_id', $tipoConceptoId)->get()
        );
    }
}