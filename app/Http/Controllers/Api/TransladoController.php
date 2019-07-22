<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Translado;
use Illuminate\Http\Request;
use App\Http\Requests\Translado as TransladoRequest;

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
        $per_page = $request->input('per_page', 25);
        $sortBy = $request->input('sortBy', 'id');
        $direction = $request->input('direction', 'DESC');

        $query = Translado::orderBy($sortBy,$direction);
        if (!empty($request->persona_id)){
            $query->where('persona_id', $request->persona_id);
        }
        if (!empty($request->origen_departamento_id)){
            $query->where('origen_departamento_id', $request->origen_departamento_id);
        }
        if (!empty($request->destino_departamento_id)){
            $query->where('destino_departamento_id', $request->destino_departamento_id);
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
        return $translado;
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
