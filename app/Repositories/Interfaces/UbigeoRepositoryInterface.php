<?php

namespace App\Repositories\Interfaces;

use App\Ubigeo;

interface UbigeoRepositoryInterface
{
    public function getByDistritoId($provinciaId);
}