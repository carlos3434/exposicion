<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AuthController extends Controller 
{
    public $successStatus = 200;
    public $unauthorizedStatus = 401;
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(Request $request) {
        $this->validateRegister($request);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('AppName')->accessToken;
        return response()->json(['success'=>$success], $this->successStatus);
    }
    protected function validateRegister(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
    protected function validateLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
    }
    public function login(Request $request){
        $this->validateLogin($request);
        if (!Auth::attempt( request(['email', 'password']) )) {
            return response()->json([
                'message' => 'Unauthorized'], $this->unauthorizedStatus);
        }
        $user = Auth::user();
        $tokenResult =  $user->createToken('AppName');
        //$success = $user;

        $user['token'] =  $tokenResult->accessToken;
        $user['token_type'] =  'Bearer';
        $user['expires_at'] = Carbon::parse($tokenResult->token->expires_at)
                                ->toDateTimeString();
        $success = $this->userRepository->getOneForLogin($user);

        return response()->json(['success' => $success], $this->successStatus);
    }

    public function logout( Request $request ) {
        $request->user()->token()->revoke();
        return response()->json(['message' =>'Successfully logged out']);
    }
    public function getUser() {
        $user = Auth::user();
        $success = $this->userRepository->getOne($user);
        return response()->json(['success' => $success], $this->successStatus);
    }
}