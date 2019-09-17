<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\ConceptoPago;
use Illuminate\Http\Request;

use App\Http\Requests\ConceptoPago as ConceptoPagoRequest;
use App\Http\Resources\ConceptoPago\ConceptoPagoCollection;
use App\Http\Resources\ConceptoPago\ConceptoPagoExcelCollection;
use App\Http\Resources\ConceptoPago\ConceptoPago as ConceptoPagoResource;

class ConceptoPagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_CONCEPTOPAGO')->only(['create','store']);
        $this->middleware('can:READ_CONCEPTOPAGO')->only('index');
        $this->middleware('can:UPDATE_CONCEPTOPAGO')->only(['edit','update']);
        $this->middleware('can:DETAIL_CONCEPTOPAGO')->only('show');
        $this->middleware('can:DELETE_CONCEPTOPAGO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ConceptoPago::filter($request)
            ->with([
                'persona',
                'cargoPostulante'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ConceptoPagoExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'concepto_pago_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ConceptoPagoCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConceptoPagoRequest $request)
    {
        $conceptoPago = ConceptoPago::create($request->all());
        return response()->json($conceptoPago, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConceptoPago  $conceptoPago
     * @return \Illuminate\Http\Response
     */
    public function show(ConceptoPago $conceptoPago)
    {
        return new ConceptoPagoResource($conceptoPago);
        //return $conceptoPago;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConceptoPago  $conceptoPago
     * @return \Illuminate\Http\Response
     */
    public function update(ConceptoPagoRequest $request, ConceptoPago $conceptoPago)
    {
        $conceptoPago->update( $request->all() );
        return response()->json($conceptoPago, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConceptoPago  $conceptoPago
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConceptoPago $conceptoPago)
    {
        $conceptoPago->delete();
        return response()->json(null, 204);
    }
}
