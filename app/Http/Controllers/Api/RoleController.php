<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use App\Http\Requests\Role as RoleRequest;
use App\Exports\Export;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\Role as RoleResource;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_ROLE')->only(['create','store']);
        $this->middleware('can:READ_ROLE')->only('index');
        $this->middleware('can:UPDATE_ROLE')->only(['edit','update']);
        $this->middleware('can:DETAIL_ROLE')->only('show');
        $this->middleware('can:DELETE_ROLE')->only('destroy');
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
        $query = Role::orderBy($sortBy,$direction);

        if(!empty($request->name)){
            $query->where('name', 'like', '%'.$request->name.'%');
        }

        if ( !empty($request->excel) || !empty($request->pdf) ){
            $type = ($request->excel) ? '.xlsx' : '.pdf';
            $headings = [ "id","name","description","special","created_at"];
            $query->select($headings);
            $rows = $query->get()->toArray();
            $export = new Export($rows,$headings);
            return Excel::download($export, 'roles_'.date('m-d-Y_hia'). $type);
        }
        return new RoleCollection($query->paginate($per_page));
        //return Role::orderBy($sortBy,$direction)->paginate($per_page);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync( $request->get('permissions') );
        return response()->json($role, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //return new RoleResource($role);
        return Role::with([ 'permissions'])->find($id)->first();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update( $request->all() );
        $role->permissions()->sync( $request->get('permissions') );
        return response()->json($role, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(null, 204);
    }
}