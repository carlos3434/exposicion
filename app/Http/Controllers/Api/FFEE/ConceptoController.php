<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Concepto;
use Illuminate\Http\Request;

use App\Http\Requests\Concepto as ConceptoRequest;
use App\Http\Resources\Concepto\ConceptoCollection;
use App\Http\Resources\Concepto\ConceptoExcelCollection;
use App\Http\Resources\Concepto\Concepto as ConceptoResource;

class ConceptoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_CONCEPTO')->only(['create','store']);
        $this->middleware('can:READ_CONCEPTO')->only('index');
        $this->middleware('can:UPDATE_CONCEPTO')->only(['edit','update']);
        $this->middleware('can:DETAIL_CONCEPTO')->only('show');
        $this->middleware('can:DELETE_CONCEPTO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Concepto::filter($request);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ConceptoExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'conceptos_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ConceptoCollection($query->sort()->paginate());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function conceptoPago(Request $request)
    {
        $query = Concepto::filter($request);
        
        return new ConceptoCollection($query->where('tipo',0)->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConceptoRequest $request)
    {
        $concepto = Concepto::create($request->all());
        return response()->json($concepto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Concepto  $concepto
     * @return \Illuminate\Http\Response
     */
    public function show(Concepto $concepto)
    {
        return new ConceptoResource($concepto);
        //return $concepto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Concepto  $concepto
     * @return \Illuminate\Http\Response
     */
    public function update(ConceptoRequest $request, Concepto $concepto)
    {
        $concepto->update( $request->all() );
        return response()->json($concepto, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Concepto  $concepto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concepto $concepto)
    {
        $concepto->delete();
        return response()->json(null, 204);
    }
}
