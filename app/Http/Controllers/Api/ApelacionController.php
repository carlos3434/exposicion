<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Apelacion;
use Illuminate\Http\Request;
use App\Http\Requests\Apelacion as ApelacionRequest;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\Apelacion\ApelacionCollection;
use App\Http\Resources\Apelacion\ApelacionExcelCollection;
use App\Http\Resources\Apelacion\Apelacion as ApelacionResource;

class ApelacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_TRANSLADO')->only(['create','store']);
        $this->middleware('can:READ_TRANSLADO')->only('index');
        $this->middleware('can:UPDATE_TRANSLADO')->only(['edit','update']);
        $this->middleware('can:DETAIL_TRANSLADO')->only('show');
        $this->middleware('can:DELETE_TRANSLADO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Apelacion::filter($request)
            ->with([
                'persona',
                'documento'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ApelacionExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'apelaciones_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ApelacionCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApelacionRequest $request)
    {
        $apelacion = Apelacion::create($request->all());
        return response()->json($apelacion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apelacion  $apelacion
     * @return \Illuminate\Http\Response
     */
    public function show(Apelacion $apelacion)
    {
        return new ApelacionResource($apelacion);
        //return $apelacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apelacion  $apelacion
     * @return \Illuminate\Http\Response
     */
    public function update(ApelacionRequest $request, Apelacion $apelacion)
    {
        $apelacion->update( $request->all() );
        return response()->json($apelacion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apelacion  $apelacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apelacion $apelacion)
    {
        $apelacion->delete();
        return response()->json(null, 204);
    }
}
