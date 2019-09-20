<?php

namespace App\Repositories\Interfaces;

use App\User;

interface UserRepositoryInterface
{
    public function all($request);
    public function getOneForLogin($user);
    public function getOne($user);
    public function newOne($request);
    public function updateOne($request, $user);
    public function deleteOne($user);
}