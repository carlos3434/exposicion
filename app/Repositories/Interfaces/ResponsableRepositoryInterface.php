<?php

namespace App\Repositories\Interfaces;

use App\Responsable;
use App\Http\Resources\Responsable\ResponsableCollection;
use App\Http\Resources\Responsable\Responsable as ResponsableResource;
use App\Http\Requests\Responsable as ResponsableRequest;

interface ResponsableRepositoryInterface
{
    public function all($request);
    public function getOne(Responsable $responsable);
    public function getByFullName( $responsable);
    public function newOne(ResponsableRequest $request);
    public function updateOne(ResponsableRequest $request, Responsable $responsable);
    public function deleteOne(Responsable $responsable);
}