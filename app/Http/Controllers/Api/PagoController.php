<?php

namespace App\Http\Controllers\Api;

use App\Pago;
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
        return new PagoCollection($query->sort()->paginate() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagoRequest $request)
    {
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
    /*public function update(PagoRequest $request, Pago $pago)
    {
        $pago->update( $request->all() );
        return response()->json($pago, 200);
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Pago $pago)
    {
        $pago->delete();
        return response()->json(null, 204);
    }*/
}
