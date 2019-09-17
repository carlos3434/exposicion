<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Translado;
use Illuminate\Http\Request;
use App\Http\Requests\Translado as TransladoRequest;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\Translado\TransladoCollection;
use App\Http\Resources\Translado\TransladoExcelCollection;
use App\Http\Resources\Translado\Translado as TransladoResource;

class TransladoController extends Controller
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
        $query = Translado::filter($request)->with([
            'origenDepartamento',
            'destinoDepartamento',
            'persona'
        ]);

        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new TransladoExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'translados_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new TransladoCollection($query->sort()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransladoRequest $request)
    {
        $translado = Translado::create($request->all());
        return response()->json($translado, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Translado  $translado
     * @return \Illuminate\Http\Response
     */
    public function show(Translado $translado)
    {
        return new TransladoResource($translado);
        //return $translado;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Translado  $translado
     * @return \Illuminate\Http\Response
     */
    public function update(TransladoRequest $request, Translado $translado)
    {
        $translado->update( $request->all() );
        return response()->json($translado, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Translado  $translado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Translado $translado)
    {
        $translado->delete();
        return response()->json(null, 204);
    }
}
