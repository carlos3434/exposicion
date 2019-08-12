<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_USER')->only(['create','store']);
        $this->middleware('can:READ_USER')->only('index');
        $this->middleware('can:UPDATE_USER')->only(['edit','update']);
        $this->middleware('can:DETAIL_USER')->only('show');
        $this->middleware('can:DELETE_USER')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('reporteria.administracion.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('reporteria.administracion.users.create', compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create( $request->all() );

        $user->roles()->sync( $request->get('roles') );
        $user->permissions()->sync( $request->get('permissions') );

        return redirect()
                    ->route('users.edit', $user->id )
                    ->with('info','User guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('reporteria.administracion.users.show', compact('user', 'roles','permissions') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('reporteria.administracion.users.edit', compact('user', 'roles','permissions') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update( $request->all() );

        $user->roles()->sync( $request->get('roles') );
        $user->permissions()->sync( $request->get('permissions') );

        return redirect()
                ->route('users.edit', $user->id )
                ->with('info','Usuario actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('info','Eliminado Correctamente');
    }
}
