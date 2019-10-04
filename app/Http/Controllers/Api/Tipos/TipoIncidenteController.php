<?php
namespace App\Http\Controllers\Api\Tipos;
use App\TipoIncidente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoIncidente as TipoIncidenteRequest;

class TipoIncidenteController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('can:CREATE_TIPOINCIDENTE')->only(['create','store']);
        $this->middleware('can:READ_TIPOINCIDENTE')->only('index');
        $this->middleware('can:UPDATE_TIPOINCIDENTE')->only(['edit','update']);
        $this->middleware('can:DETAIL_TIPOINCIDENTE')->only('show');
        $this->middleware('can:DELETE_TIPOINCIDENTE')->only('destroy');
    }*/
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

        $query = TipoIncidente::orderBy($sortBy,$direction);

        //return $query->paginate($per_page);
        return $query->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoIncidenteRequest $request)
    {
        $tipoIncidente = TipoIncidente::create($request->all());
        return response()->json($tipoIncidente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoIncidente  $tipoIncidente
     * @return \Illuminate\Http\Response
     */
    public function show(TipoIncidente $tipoIncidente)
    {
        return $tipoIncidente;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoIncidente  $tipoIncidente
     * @return \Illuminate\Http\Response
     */
    public function update(TipoIncidenteRequest $request, TipoIncidente $tipoIncidente)
    {
        $tipoIncidente->update( $request->all() );
        return response()->json($tipoIncidente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoIncidente  $tipoIncidente
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoIncidente $tipoIncidente)
    {
        $tipoIncidente->delete();
        return response()->json(null, 204);
    }
}
