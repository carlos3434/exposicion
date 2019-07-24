<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Apelacion;
use Illuminate\Http\Request;
use App\Http\Requests\Apelacion as ApelacionRequest;
use App\Exports\Export;
use Maatwebsite\Excel\Facades\Excel;
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
        $per_page = $request->input('per_page', 25);
        $sortBy = $request->input('sortBy', 'id');
        $direction = $request->input('direction', 'DESC');

        $query = Apelacion::orderBy($sortBy,$direction);
        if (!empty($request->persona_id)){
            $query->where('persona_id', $request->persona_id);
        }
        if (!empty($request->documento_id)){
            $query->where('documento_id', $request->documento_id);
        }// se refiere al foregin key de proceso_disciplinarios

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
        $name='apelaciones_'.date('m-d-Y_hia');

        if ( !empty($request->excel) || !empty($request->pdf) ){
            $type = ($request->excel) ? '.xlsx' : '.pdf';
            $headings = [ "id","fecha_registro", "resolucion", "is_titular", "representanteNombres" , "representanteApellidoPaterno", "representanteApellidoMaterno","documento_id","created_at"];
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
        return $apelacion;
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
