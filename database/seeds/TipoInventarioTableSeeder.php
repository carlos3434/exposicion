<?php

use Illuminate\Database\Seeder;
use App\TipoInventario;

class TipoInventarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoInventario::create([
            'name'      => 'TIPO 1: B Muebles',
        ]);
        TipoInventario::create([
            'name'      => 'TIPO 2: B Inmuebles',
        ]);
        TipoInventario::create([
            'name'      => 'TIPO 3',
        ]);
        TipoInventario::create([
            'name'      => 'TIPO 4',
        ]);
        TipoInventario::create([
            'name'      => 'TIPO 5',
        ]);
    }
}
