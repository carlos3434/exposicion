<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\InvoiceDetail;
use Illuminate\Http\Request;

use App\Http\Requests\InvoiceDetail as InvoiceDetailRequest;
use App\Http\Resources\InvoiceDetail\InvoiceDetailCollection;
use App\Http\Resources\InvoiceDetail\InvoiceDetailExcelCollection;
use App\Http\Resources\InvoiceDetail\InvoiceDetail as InvoiceDetailResource;

class InvoiceDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_INVOICEDETAIL')->only(['create','store']);
        $this->middleware('can:READ_INVOICEDETAIL')->only('index');
        $this->middleware('can:UPDATE_INVOICEDETAIL')->only(['edit','update']);
        $this->middleware('can:DETAIL_INVOICEDETAIL')->only('show');
        $this->middleware('can:DELETE_INVOICEDETAIL')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = InvoiceDetail::filter($request)
            ->with([
                'persona',
                'cargoPostulante'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new InvoiceDetailExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'invoice_detail_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new InvoiceDetailCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceDetailRequest $request)
    {
        $invoiceDetail = InvoiceDetail::create($request->all());
        return response()->json($invoiceDetail, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceDetail $invoiceDetail)
    {
        return new InvoiceDetailResource($invoiceDetail);
        //return $invoiceDetail;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceDetailRequest $request, InvoiceDetail $invoiceDetail)
    {
        $invoiceDetail->update( $request->all() );
        return response()->json($invoiceDetail, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceDetail $invoiceDetail)
    {
        $invoiceDetail->delete();
        return response()->json(null, 204);
    }
}
