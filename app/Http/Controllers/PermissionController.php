<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

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
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('reporteria.administracion.permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reporteria.administracion.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = Permission::create( $request->all() );
        return redirect()
                    ->route('permissions.edit', $permission->id )
                    ->with('info','Permiso guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('reporteria.administracion.permissions.show', ['permission'=>$permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('reporteria.administracion.permissions.edit', ['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $permission->update( $request->all() );

        return redirect()
                ->route('permissions.edit', $permission->id )
                ->with('info','Permiso actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('info','Eliminado Correctamente');
    }
}
