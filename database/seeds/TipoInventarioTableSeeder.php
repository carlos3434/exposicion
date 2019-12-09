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
            'name'      => 'TIPO 1',
        ]);
        TipoInventario::create([
            'name'      => 'TIPO 2',
        ]);
    }
}
