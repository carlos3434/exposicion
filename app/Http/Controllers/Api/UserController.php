<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\User as UserRequest;

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
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 25);
        $sortBy = $request->input('sortBy', 'id');
        $direction = $request->input('direction', 'DESC');

        $query = User::orderBy($sortBy,$direction);
        if(!empty($request->name)){
            $query->where('name', 'like', '%'.$request->name.'%');
        }

        return $query->paginate($per_page);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update( $request->all() );
        return response()->json($user, 200);
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
        return response()->json(null, 204);
    }
}