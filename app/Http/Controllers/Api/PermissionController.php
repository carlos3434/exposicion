<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Permission;
use App\Http\Requests\Permission as PermissionRequest;
use App\Exports\Export;
use Maatwebsite\Excel\Facades\Excel;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_PERMISSION')->only(['create','store']);
        $this->middleware('can:READ_PERMISSION')->only('index');
        $this->middleware('can:UPDATE_PERMISSION')->only(['edit','update']);
        $this->middleware('can:DETAIL_PERMISSION')->only('show');
        $this->middleware('can:DELETE_PERMISSION')->only('destroy');
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

        $query = Permission::orderBy($sortBy,$direction);

        if(!empty($request->name)){
            $query->where('name', 'like', '%'.$request->name.'%');
        }
        $name='permisos_'.date('m-d-Y_hia');

        if ( !empty($request->excel) || !empty($request->pdf) ){
            $type = ($request->excel) ? '.xlsx' : '.pdf';
            $headings = [ "id","name","description","created_at"];
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
    public function store(PermissionRequest $request)
    {
        $permission = Permission::create($request->all());
        return response()->json($permission, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return $permission;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update( $request->all() );
        return response()->json($permission, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(null, 204);
    }
}