<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ResultadoEleccion;
use Illuminate\Http\Request;
use App\Http\Requests\ResultadoEleccion as ResultadoEleccionRequest;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\ResultadoEleccion\ResultadoEleccionCollection;
use App\Http\Resources\ResultadoEleccion\ResultadoEleccionExcelCollection;
use App\Http\Resources\ResultadoEleccion\ResultadoEleccion as ResultadoEleccionResource;

class ResultadoEleccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_RESULTADOELECCION')->only(['create','store']);
        $this->middleware('can:READ_RESULTADOELECCION')->only('index');
        $this->middleware('can:UPDATE_RESULTADOELECCION')->only(['edit','update']);
        $this->middleware('can:DETAIL_RESULTADOELECCION')->only('show');
        $this->middleware('can:DELETE_RESULTADOELECCION')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ResultadoEleccion::filter($request)
            ->with([
                'departamento'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ResultadoEleccionExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'resultados_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ResultadoEleccionCollection($query->sort()->paginate());
        //return $query->paginate($per_page);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResultadoEleccionRequest $request)
    {
        $resultadoEleccion = ResultadoEleccion::create($request->all());
        return response()->json($resultadoEleccion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return \Illuminate\Http\Response
     */
    public function show(ResultadoEleccion $resultadoEleccion)
    {
        return new ResultadoEleccionResource($resultadoEleccion);
        //return $resultadoEleccion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return \Illuminate\Http\Response
     */
    public function update(ResultadoEleccionRequest $request, ResultadoEleccion $resultadoEleccion)
    {
        $resultadoEleccion->update( $request->all() );
        return response()->json($resultadoEleccion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResultadoEleccion  $resultadoEleccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultadoEleccion $resultadoEleccion)
    {
        $resultadoEleccion->delete();
        return response()->json(null, 204);
    }
}
