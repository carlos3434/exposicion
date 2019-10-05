<?php

namespace App\Repositories\Interfaces;

use App\Empresa;
use App\Http\Resources\Empresa\EmpresaCollection;
use App\Http\Resources\Empresa\Empresa as EmpresaResource;
use App\Http\Requests\Empresa as EmpresaRequest;

interface EmpresaRepositoryInterface
{
    public function all($request);
    public function getOne(Empresa $empresa);
    public function getById( $empresa);
    public function newOne(EmpresaRequest $request);
    public function updateOne(EmpresaRequest $request, Empresa $empresa);
    public function deleteOne(Empresa $empresa);
}