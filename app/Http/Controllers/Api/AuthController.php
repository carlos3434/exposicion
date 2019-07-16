<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller 
{
    public $successStatus = 200;

    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            //'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('AppName')->accessToken;
        return response()->json(['success'=>$success], $this->successStatus);

    }

    public function login(){

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user() ;

            $success['token'] =  $user->createToken('AppName')->accessToken;

            $permissions = $roles =[];
            foreach($user->roles as $role)
            {
                foreach($role->permissions as $permission)
                {
                    array_push($permissions, $permission->slug);
                }
                $rol = ['name'=>$role->name,'special'=>$role->special];
                array_push($roles, $rol);
            }

            foreach( $user->permissions as $permission)
            {
                array_push($permissions, $permission->slug);
            }

            $success['rol'] = $roles;
            $success['permissions'] = $permissions;

            return response()->json(['success' => $success], $this-> successStatus);
        } else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }

    public function getUser() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}