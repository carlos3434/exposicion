<?php
namespace App\Http\Controllers\Api;
use App\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Departamento as DepartamentoRequest;

class DepartamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_DEPARTAMENTO')->only(['create','store']);
        $this->middleware('can:READ_DEPARTAMENTO')->only('index');
        $this->middleware('can:UPDATE_DEPARTAMENTO')->only(['edit','update']);
        $this->middleware('can:DETAIL_DEPARTAMENTO')->only('show');
        $this->middleware('can:DELETE_DEPARTAMENTO')->only('destroy');
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

        $query = Departamento::orderBy($sortBy,$direction);

        return $query->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoRequest $request)
    {
        $departamento = Departamento::create($request->all());
        return response()->json($departamento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        return $departamento;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(DepartamentoRequest $request, Departamento $departamento)
    {
        $departamento->update( $request->all() );
        return response()->json($departamento, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        $departamento->delete();
        return response()->json(null, 204);
    }
}
