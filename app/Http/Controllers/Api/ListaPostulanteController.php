<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ListaPostulante;
use Illuminate\Http\Request;
use App\Http\Requests\ListaPostulante as ListaPostulanteRequest;
use App\Exports\Export;
use Maatwebsite\Excel\Facades\Excel;

class ListaPostulanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_LISTAPOSTULANTE')->only(['create','store']);
        $this->middleware('can:READ_LISTAPOSTULANTE')->only('index');
        $this->middleware('can:UPDATE_LISTAPOSTULANTE')->only(['edit','update']);
        $this->middleware('can:DETAIL_LISTAPOSTULANTE')->only('show');
        $this->middleware('can:DELETE_LISTAPOSTULANTE')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 25);
        $sortBy = $request->input('sortBy', 'id');
        $direction = $request->input('direction', 'DESC');

        $query = ListaPostulante::orderBy($sortBy,$direction);
        if (!empty($request->persona_id)){
            $query->where('persona_id', $request->persona_id);
        }
        if (!empty($request->cargo_postulante_id)){
            $query->where('cargo_postulante_id', $request->cargo_postulante_id);
        }
        if (!empty($request->departamento_id)){
            $query->where('departamento_id', $request->departamento_id);
        }

        if (!empty($request->fecha_registro)){
            if (is_array($request->fecha_registro) && count($request->fecha_registro) > 0) {
                foreach ( $request->fecha_registro as $fecha_registro) {
                    if (isset($fecha_registro)) {
                        $query->orWhere('fecha_registro', $fecha_registro);
                    }
                }
            } elseif (trim($request->fecha_registro) !=='') {
                $query->where('fecha_registro', $request->fecha_registro);
            }
        }
        $name='comites_'.date('m-d-Y_hia');

        if ( !empty($request->excel) || !empty($request->pdf) ){
            $type = ($request->excel) ? '.xlsx' : '.pdf';
            $headings = [ "id","fecha_registro", "lista", "proceso", "observacion" , "cargo_postulante_id", "departamento_id" , "persona_id", "created_by" ];
            $query->select($headings);
            $rows = $query->get()->toArray();
            $export = new Export($rows,$headings);
            return Excel::download($export, $name. $type);
        }
        return $query->paginate($per_page);
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
        return $listaPostulante;
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
