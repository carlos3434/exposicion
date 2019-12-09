<?php

use Illuminate\Database\Seeder;
use App\TipoRendicion;

class TipoRendicionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoRendicion::create([
            'name'              => 'COMPRA',
        ]);
        TipoRendicion::create([
            'name'              => 'GASTO',
        ]);
    }
}
