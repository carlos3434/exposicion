<?php

namespace App\Http\Controllers\Api;

use App\Pago;
use App\EstadoPago;
use Illuminate\Http\Request;
use App\Http\Requests\Pago as PagoRequest;
use App\Http\Controllers\Controller;

use App\Http\Resources\Pago\PagoCollection;
//use App\Http\Resources\Pago\PagoExcelCollection;
//use App\Http\Resources\Pago\Pago as PagoResource;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_PAGO')->only(['create','store']);
        $this->middleware('can:READ_PAGO')->only('index');
        $this->middleware('can:UPDATE_PAGO')->only(['edit','update']);
        $this->middleware('can:DETAIL_PAGO')->only('show');
        $this->middleware('can:DELETE_PAGO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Pago::filter($request)
            ->with([
                'childrenPagos',
                'concepto',
                'estadoPago'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new PagoExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'Pagos_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new PagoCollection($query->sort()->where('pago_id',null)->paginate() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagoRequest $request)
    {
        //si tiene padre, cambiar el flag is_fraccion a 1
        if ( $request->has('pago_id') ) {
            //validar si el pago padre ya esta completado
            $pagoPadre = Pago::find($request->pago_id);
            if ($pagoPadre->estado_pago_id == EstadoPago::COMPLETADA) {
                return response()->json('El pago al que intenta fraccionar ya se ha completado y no se puede realizar fraccionamiento', 500);
            }
            //validar si la sumatoria de pagos no excede al total del padre
            
            $montoTotal = $pagoPadre->monto;
            $sum = 0;
            foreach ($pagoPadre->childrenPagos as $pagoChildren) {
                $sum += $pagoChildren->monto;
            }
            $sum += $request->monto;
            if ( $sum > $montoTotal ) {
                return response()->json('La sumatoria de los pagos fraccionados no debe superar el total del pago', 500);
            }

            $pagoPadre->is_fraccion = 1;
            $pagoPadre->estado_pago_id = EstadoPago::FRACCIONADA;
            $pagoPadre->save();
            $request->merge([ 'is_fraccion' => 0, 'concepto_id' => $pagoPadre->concepto_id ]);
        }
        $pago = Pago::create($request->all());
        return response()->json($pago, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    /*public function show(Pago $pago)
    {
        return new PagoResource($pago);
        //return $pago;
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(PagoRequest $request, Pago $pago)
    {
        $pago->update( $request->all() );
        return response()->json($pago, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        $pagoPadreId = $pago->pago_id;
        //si ya no tiene mas pagos fraccionanos, cambiar el estado a pendiente
        $pago->delete();
        $pagoPadre = Pago::find( $pagoPadreId );
        
        if ( $pagoPadre ) {
            
            $sum = 0;
            foreach ($pagoPadre->childrenPagos as $pagoChildren) {
                $sum += $pagoChildren->monto;
            }
            if ( $sum == 0  ) {
                $pagoPadre->is_fraccion = 0;
                $pagoPadre->estado_pago_id = EstadoPago::PENDIENTE;
                $pagoPadre->save();
            }
        }
        return response()->json(null, 204);
    }
}
