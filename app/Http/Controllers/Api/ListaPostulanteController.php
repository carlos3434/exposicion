<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ListaPostulante;
use Illuminate\Http\Request;
use App\Http\Requests\ListaPostulante as ListaPostulanteRequest;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\ListaPostulante\ListaPostulanteCollection;
use App\Http\Resources\ListaPostulante\ListaPostulanteExcelCollection;
use App\Http\Resources\ListaPostulante\ListaPostulante as ListaPostulanteResource;

class ListaPostulanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_LISTAPOSTULANTES')->only(['create','store']);
        $this->middleware('can:READ_LISTAPOSTULANTES')->only('index');
        $this->middleware('can:UPDATE_LISTAPOSTULANTES')->only(['edit','update']);
        $this->middleware('can:DETAIL_LISTAPOSTULANTES')->only('show');
        $this->middleware('can:DELETE_LISTAPOSTULANTES')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ListaPostulante::filter($request)
            ->with([
                'cargoPostulante',
                'departamento',
                'persona'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ListaPostulanteExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'listas_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ListaPostulanteCollection($query->sort()->paginate());
        //return $query->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $listaPostulante = ListaPostulante::create($request->all());
        return response()->json($listaPostulante, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ListaPostulante  $listaPostulante
     * @return \Illuminate\Http\Response
     */
    public function show(ListaPostulante $listaPostulante)
    {
        return new ListaPostulanteResource($listaPostulante);
        //return $listaPostulante;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListaPostulante  $listaPostulante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListaPostulante $listaPostulante)
    {
        $listaPostulante->update( $request->all() );
        return response()->json($listaPostulante, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListaPostulante  $listaPostulante
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListaPostulante $listaPostulante)
    {
        $listaPostulante->delete();
        return response()->json(null, 204);
    }
}
