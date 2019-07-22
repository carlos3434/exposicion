<?php

namespace App\Http\Controllers\Api;

use App\ProcesoDisciplinario;
use Illuminate\Http\Request;
use App\Http\Requests\ProcesoDisciplinario as ProcesoDisciplinarioRequest;
use App\Http\Controllers\Controller;

class ProcesoDisciplinarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_PROCESODISCIPLINARIO')->only(['create','store']);
        $this->middleware('can:READ_PROCESODISCIPLINARIO')->only('index');
        $this->middleware('can:UPDATE_PROCESODISCIPLINARIO')->only(['edit','update']);
        $this->middleware('can:DETAIL_PROCESODISCIPLINARIO')->only('show');
        $this->middleware('can:DELETE_PROCESODISCIPLINARIO')->only('destroy');
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

        $query = ProcesoDisciplinario::orderBy($sortBy,$direction);
        if (!empty($request->persona_id)){
            $query->where('persona_id', $request->persona_id);
        }
        if (!empty($request->sancion_id)){
            $query->where('sancion_id', $request->sancion_id);
        }
        if (!empty($request->tipo_proceso_disciplinario_id)){
            $query->where('tipo_proceso_disciplinario_id', $request->tipo_proceso_disciplinario_id);
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
    public function store(ProcesoDisciplinarioRequest $request)
    {
        $procesoDisciplinario = ProcesoDisciplinario::create($request->all());
        return response()->json($procesoDisciplinario, 201);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcesoDisciplinario $procesoDisciplinario)
    {
        return $procesoDisciplinario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return \Illuminate\Http\Response
     */
    public function update(ProcesoDisciplinarioRequest $request, ProcesoDisciplinario $procesoDisciplinario)
    {
        $procesoDisciplinario->update( $request->all() );
        return response()->json($procesoDisciplinario, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcesoDisciplinario $procesoDisciplinario)
    {
        $procesoDisciplinario->delete();
        return response()->json(null, 204);
    }
}
