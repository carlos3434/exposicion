<?php

namespace App\Http\Controllers\Api;

use App\Licencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Licencia as LicenciaRequest;

class LicenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_LICENCIA')->only(['create','store']);
        $this->middleware('can:READ_LICENCIA')->only('index');
        $this->middleware('can:UPDATE_LICENCIA')->only(['edit','update']);
        $this->middleware('can:DETAIL_LICENCIA')->only('show');
        $this->middleware('can:DELETE_LICENCIA')->only('destroy');
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

        $query = Licencia::orderBy($sortBy,$direction);
        if (!empty($request->persona_id)){
            $query->where('persona_id', $request->persona_id);
        }
        if (!empty($request->fecha_inicio)){
            $query->where('fecha_inicio', $request->fecha_inicio);
        }
        if (!empty($request->fecha_fin)){
            $query->where('fecha_fin', $request->fecha_fin);
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
    public function store(LicenciaRequest $request)
    {
        $licencia = Licencia::create($request->all());
        return response()->json($licencia, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function show(Licencia $licencia)
    {
        return $licencia;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function update(LicenciaRequest $request, Licencia $licencia)
    {
        $licencia->update( $request->all() );
        return response()->json($licencia, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licencia $licencia)
    {
        $licencia->delete();
        return response()->json(null, 204);
    }
}
