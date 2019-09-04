<?php

namespace App\Http\Controllers\Api;

use App\ProcesoDisciplinario;
use Illuminate\Http\Request;
use App\Http\Requests\ProcesoDisciplinario as ProcesoDisciplinarioRequest;
use App\Http\Controllers\Controller;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\ProcesoDisciplinario\ProcesoDisciplinarioCollection;
use App\Http\Resources\ProcesoDisciplinario\ProcesoDisciplinarioExcelCollection;
use App\Http\Resources\ProcesoDisciplinario\ProcesoDisciplinario as ProcesoDisciplinarioResource;

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

        $query = ProcesoDisciplinario::filter($request)
            ->with([
                'persona',
                'sancion',
                'tipoProcesoDisciplinario',
        ])->orderBy($sortBy,$direction);

        $name='procesos_disciplinarios_'.date('m-d-Y_hia');

        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ProcesoDisciplinarioExcelCollection( $query->get() );

                return $result->downloadExcel(
                    $name.'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ProcesoDisciplinarioCollection($query->paginate($per_page));
        //return $query->paginate($per_page);
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
    public function show(ProcesoDisciplinario $procesoDisciplinario)
    {
        return new ProcesoDisciplinarioResource($procesoDisciplinario);
        //return $procesoDisciplinario;
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
