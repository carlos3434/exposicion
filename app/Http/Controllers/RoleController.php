<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

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
    public function index()
    {
        $roles = Role::paginate(10);
        return view('reporteria.administracion.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('reporteria.administracion.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create( $request->all() );

        $role->permissions()->sync( $request->get('permissions') );

        return redirect()
                    ->route('roles.edit', $role->id )
                    ->with('info','Role guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::get();
        return view('reporteria.administracion.roles.show', compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        return view('reporteria.administracion.roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update( $request->all() );

        $role->permissions()->sync( $request->get('permissions') );

        return redirect()
                ->route('role.edit', $role->id )
                ->with('info','Rol actualizado con exito');
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

        return back()->with('info','Eliminado Correctamente');
    }
}
