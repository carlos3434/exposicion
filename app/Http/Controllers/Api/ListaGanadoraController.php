<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ListaGanadora;
use Illuminate\Http\Request;
use App\Http\Requests\ListaGanadora as ListaGanadoraRequest;
use App\Exports\Export;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\ListaGanadora\ListaGanadoraCollection;
use App\Http\Resources\ListaGanadora\ListaGanadora as ListaGanadoraResource;

class ListaGanadoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_LISTAGANADORA')->only(['create','store']);
        $this->middleware('can:READ_LISTAGANADORA')->only('index');
        $this->middleware('can:UPDATE_LISTAGANADORA')->only(['edit','update']);
        $this->middleware('can:DETAIL_LISTAGANADORA')->only('show');
        $this->middleware('can:DELETE_LISTAGANADORA')->only('destroy');
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

        $query = ListaGanadora::orderBy($sortBy,$direction);
        if (!empty($request->cargo_postulante_id)){
            $query->where('cargo_postulante_id', $request->cargo_postulante_id);
        }
        if (!empty($request->departamento_id)){
            $query->where('departamento_id', $request->departamento_id);
        }
        if (!empty($request->persona_id)){
            $query->where('persona_id', $request->persona_id);
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
            $headings = [ "id","fecha_registro", "periodo", "cargo_postulante_id", "departamento_id" , "persona_id","created_by"];
            $query->select($headings);
            $rows = $query->get()->toArray();
            $export = new Export($rows,$headings);
            return Excel::download($export, $name. $type);
        }
        return new ListaGanadoraCollection($query->paginate($per_page));
        //return $query->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListaGanadoraRequest $request)
    {
        $listaGanadora = ListaGanadora::create($request->all());
        return response()->json($listaGanadora, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return \Illuminate\Http\Response
     */
    public function show(ListaGanadora $listaGanadora)
    {
        return new ListaGanadoraResource($listaGanadora);
        //return $listaGanadora;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListaGanadora  $listaGanadora
     * @return \Illuminate\Http\Response
     */
    public function update(ListaGanadoraRequest $request, ListaGanadora $listaGanadora)
    {
        $listaGanadora->update( $request->all() );
        return response()->json($listaGanadora, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListaGanadora $listaGanadora)
    {
        $listaGanadora->delete();
        return response()->json(null, 204);
    }
}
