<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\TipoInvoice;
use Illuminate\Http\Request;

use App\Http\Requests\TipoInvoice as TipoInvoiceRequest;
use App\Http\Resources\TipoInvoice\TipoInvoiceCollection;
use App\Http\Resources\TipoInvoice\TipoInvoiceExcelCollection;
use App\Http\Resources\TipoInvoice\TipoInvoice as TipoInvoiceResource;

class TipoInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_TIPOINVOICE')->only(['create','store']);
        $this->middleware('can:READ_TIPOINVOICE')->only('index');
        $this->middleware('can:UPDATE_TIPOINVOICE')->only(['edit','update']);
        $this->middleware('can:DETAIL_TIPOINVOICE')->only('show');
        $this->middleware('can:DELETE_TIPOINVOICE')->only('destroy');
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TipoInvoice::filter($request)
            ->with([
                'persona',
                'cargoPostulante'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new TipoInvoiceExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'tipo_invoice_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new TipoInvoiceCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoInvoiceRequest $request)
    {
        $tipoInvoice = TipoInvoice::create($request->all());
        return response()->json($tipoInvoice, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoInvoice  $tipoInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(TipoInvoice $tipoInvoice)
    {
        return new TipoInvoiceResource($tipoInvoice);
        //return $tipoInvoice;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoInvoice  $tipoInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(TipoInvoiceRequest $request, TipoInvoice $tipoInvoice)
    {
        $tipoInvoice->update( $request->all() );
        return response()->json($tipoInvoice, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoInvoice  $tipoInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoInvoice $tipoInvoice)
    {
        $tipoInvoice->delete();
        return response()->json(null, 204);
    }
}
