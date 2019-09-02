<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ResultadoEleccion;
use Illuminate\Http\Request;
use App\Http\Requests\ResultadoEleccion as ResultadoEleccionRequest;
use App\Exports\Export;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\ResultadoEleccion\ResultadoEleccionCollection;
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
        $per_page = $request->input('per_page', 25);
        $sortBy = $request->input('sortBy', 'id');
        $direction = $request->input('direction', 'DESC');

        $query = ResultadoEleccion::orderBy($sortBy,$direction);
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
            $headings = [ "id","fecha_registro", "lista_ganadora", "numero_votantes", "numero_novotantes" , "numero_votos", "observacion", "departamento_id" , "created_by"];
            $query->select($headings);
            $rows = $query->get()->toArray();
            $export = new Export($rows,$headings);
            return Excel::download($export, $name. $type);
        }
        return new ResultadoEleccionCollection($query->paginate($per_page));
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
