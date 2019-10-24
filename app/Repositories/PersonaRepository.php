<?php
namespace App\Repositories;

use DB;
use App\Repositories\Interfaces\PersonaRepositoryInterface;
/**
 * 
 */
class PersonaRepository implements PersonaRepositoryInterface
{
    public function getMaxNumeroCmvp( )
    {
        return (int) DB::table('personas')->max('numero_cmvp');
    }
}