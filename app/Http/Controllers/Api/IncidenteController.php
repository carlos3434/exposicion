<?php

namespace App\Http\Controllers\Api;

use App\Incidente;
use Illuminate\Http\Request;
use App\Http\Requests\Incidente as IncidenteRequest;
use App\Http\Controllers\Controller;

class IncidenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_INCIDENTE')->only(['create','store']);
        $this->middleware('can:READ_INCIDENTE')->only('index');
        $this->middleware('can:UPDATE_INCIDENTE')->only(['edit','update']);
        $this->middleware('can:DETAIL_INCIDENTE')->only('show');
        $this->middleware('can:DELETE_INCIDENTE')->only('destroy');
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

        $query = Incidente::orderBy($sortBy,$direction);
        if (!empty($request->persona_id)){
            $query->where('persona_id', $request->persona_id);
        }
        if (!empty($request->tipo_incidente_id)){
            $query->where('tipo_incidente_id', $request->tipo_incidente_id);
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

        return $query->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncidenteRequest $request)
    {
        $incidente = Incidente::create($request->all());
        return response()->json($incidente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Incidente  $incidente
     * @return \Illuminate\Http\Response
     */
    public function show(Incidente $incidente)
    {
        return $incidente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Incidente  $incidente
     * @return \Illuminate\Http\Response
     */
    public function update(IncidenteRequest $request, Incidente $incidente)
    {
        $incidente->update( $request->all() );
        return response()->json($incidente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Incidente  $incidente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidente $incidente)
    {
        $incidente->delete();
        return response()->json(null, 204);
    }
}
