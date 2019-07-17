<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EntregaDiploma;

class EntregaDiplomaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_ENTREGADIPLOMA')->only(['create','store']);
        $this->middleware('can:READ_ENTREGADIPLOMA')->only('index');
        $this->middleware('can:UPDATE_ENTREGADIPLOMA')->only(['edit','update']);
        $this->middleware('can:DETAIL_ENTREGADIPLOMA')->only('show');
        $this->middleware('can:DELETE_ENTREGADIPLOMA')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 25);
        return EntregaDiploma::paginate($per_page);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entregaDiploma = EntregaDiploma::create($request->all());
        return response()->json($article, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EntregaDiploma $entregaDiploma)
    {
        return $entregaDiploma;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntregaDiploma  $entregaDiploma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntregaDiploma $entregaDiploma)
    {
        $entregaDiploma->update( $request->all() );
        return response()->json($entregaDiploma, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntregaDiploma  $entregaDiploma
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntregaDiploma $entregaDiploma)
    {
        $entregaDiploma->delete();
        return response()->json(null, 204);
    }
}