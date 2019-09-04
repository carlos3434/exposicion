<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EntregaDiploma;
use App\Http\Requests\EntregaDiploma as EntregaDiplomaRequest;

//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\EntregaDiploma\EntregaDiplomaCollection;
use App\Http\Resources\EntregaDiploma\EntregaDiplomaExcelCollection;
use App\Http\Resources\EntregaDiploma\EntregaDiploma as EntregaDiplomaResource;

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
        $sortBy = $request->input('sortBy', 'entrega_diplomas.id');
        $direction = $request->input('direction', 'DESC');

        $name='entrega_diplomas_'.date('m-d-Y_hia');
        $query = EntregaDiploma::filter($request)
            ->with([
                'departamento'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new EntregaDiplomaExcelCollection( $query->get() );

                return $result->downloadExcel(
                    $name.'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new EntregaDiplomaCollection($query->paginate($per_page));
        //return $query->paginate($per_page);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntregaDiplomaRequest $request)
    {
        $entregaDiploma = EntregaDiploma::create($request->all());
        return response()->json($entregaDiploma, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EntregaDiploma $entregaDiploma)
    //public function show( $id)
    {
        return new EntregaDiplomaResource($entregaDiploma);
        //return new PermissionResource($permission);
        //return EntregaDiploma::find($id);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntregaDiploma  $entregaDiploma
     * @return \Illuminate\Http\Response
     */
    public function update(EntregaDiplomaRequest $request, EntregaDiploma $entregaDiploma)
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