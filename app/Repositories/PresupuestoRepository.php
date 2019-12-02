<?php
namespace App\Repositories;

use App\Presupuesto;
use App\Http\Resources\Presupuesto\PresupuestoCollection;
use App\Http\Resources\Presupuesto\Presupuesto as PresupuestoResource;
use App\Http\Requests\Presupuesto as PresupuestoRequest;
use Greenter\Model\DocumentInterface;
use DB;

use App\Repositories\Interfaces\PresupuestoRepositoryInterface;
/**
 * 
 */
class PresupuestoRepository implements PresupuestoRepositoryInterface
{
    public function all($request)
    {
        return new PresupuestoCollection(
            Presupuesto::filter($request)->sort()->paginate()
        );
    }
    public function allForExcel($request)
    {
        return new PresupuestoCollection(
            Presupuesto::filter($request)->get()
        );
    }
}