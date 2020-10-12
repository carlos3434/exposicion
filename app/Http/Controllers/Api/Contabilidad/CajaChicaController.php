<?php

namespace App\Http\Controllers\Api\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CajaChica;
use App\Http\Requests\CajaChica as CajaChicaRequest;

use App\Http\Resources\CajaChica\CajaChicaCollection;
use App\Http\Resources\CajaChica\CajaChicaExcelCollection;
use App\Http\Resources\CajaChica\CajaChica as CajaChicaResource;


class CajaChicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_CAJACHICA')->only(['create','store']);
        $this->middleware('can:READ_CAJACHICA')->only('index');
        $this->middleware('can:UPDATE_CAJACHICA')->only(['edit','update']);
        $this->middleware('can:DETAIL_CAJACHICA')->only('show');
        $this->middleware('can:DELETE_CAJACHICA')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CajaChica::filter($request)
            ->with([
                'departamento',
                'tipoDocumentoPago',
                'concepto'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new CajaChicaExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'CajaChicas_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new CajaChicaCollection($query->sort()->paginate());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CajaChicaRequest $request)
    {
        $cajaChica = CajaChica::create($request->all());
        return new CajaChicaResource($cajaChica);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CajaChica  $cajaChica
     * @return \Illuminate\Http\Response
     */
    public function show(CajaChica $cajaChica)
    {
        return new CajaChicaResource($cajaChica);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CajaChica  $cajaChica
     * @return \Illuminate\Http\Response
     */
    public function update(CajaChicaRequest $request, CajaChica $cajaChica)
    {
        $cajaChica->update( $request->all() );
        return new CajaChicaResource($cajaChica);
        //return response()->json($cajaChica, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CajaChica  $cajaChica
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaChica $cajaChica)
    {
        $cajaChica->delete();
        return response()->json(null, 204);
    }
}
