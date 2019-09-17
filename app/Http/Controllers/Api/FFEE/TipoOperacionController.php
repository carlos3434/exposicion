<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\TipoOperacion;
use Illuminate\Http\Request;

use App\Http\Requests\TipoOperacion as TipoOperacionRequest;
use App\Http\Resources\TipoOperacion\TipoOperacionCollection;
use App\Http\Resources\TipoOperacion\TipoOperacionExcelCollection;
use App\Http\Resources\TipoOperacion\TipoOperacion as TipoOperacionResource;

class TipoOperacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_TIPOOPERACION')->only(['create','store']);
        $this->middleware('can:READ_TIPOOPERACION')->only('index');
        $this->middleware('can:UPDATE_TIPOOPERACION')->only(['edit','update']);
        $this->middleware('can:DETAIL_TIPOOPERACION')->only('show');
        $this->middleware('can:DELETE_TIPOOPERACION')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TipoOperacion::filter($request)
            ->with([
                'persona',
                'cargoPostulante'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new TipoOperacionExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'tipo_operacion_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new TipoOperacionCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoOperacionRequest $request)
    {
        $tipoOperacion = TipoOperacion::create($request->all());
        return response()->json($tipoOperacion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoOperacion  $tipoOperacion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoOperacion $tipoOperacion)
    {
        return new TipoOperacionResource($tipoOperacion);
        //return $tipoOperacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoOperacion  $tipoOperacion
     * @return \Illuminate\Http\Response
     */
    public function update(TipoOperacionRequest $request, TipoOperacion $tipoOperacion)
    {
        $tipoOperacion->update( $request->all() );
        return response()->json($tipoOperacion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoOperacion  $tipoOperacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoOperacion $tipoOperacion)
    {
        $tipoOperacion->delete();
        return response()->json(null, 204);
    }
}
