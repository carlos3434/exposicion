<?php
namespace App\Repositories;

use App\User;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserForLogin as UserResourceForLogin;

use App\Repositories\Interfaces\UserRepositoryInterface;
/**
 * 
 */
class UserRepository implements UserRepositoryInterface
{
    public function all($filters)
    {
        return new UserCollection(
            //User::filter($request)->sort()->paginate()
            User::filter($filters)->orderBy('id','desc')->paginate()
        );
    }
    public function getOneForLogin($user)
    {
        return new UserResourceForLogin($user);
    }
    public function getOne($user)
    {
        return new UserResource($user);
    }
    public function newOne($request)
    {
        $user = User::create($request->all());
        $user->createToken('AppName')->accessToken;
        $this->syncRolesAndPermissions($request, $user);
        return $user;
    }
    public function updateOne($request, $user)
    {
        $user->update( $request->all() );
        $this->syncRolesAndPermissions($request, $user);
        return $user;
    }
    public function deleteOne($user)
    {
        $user->delete();
    }

    private function syncRolesAndPermissions($request, &$user)
    {
        if ($request->has('roles')) {
            $user->roles()->sync( $request->get('roles') );
        }
        if ($request->has('permissions')) {
            $user->permissions()->sync( $request->get('permissions') );
        }
    }
}