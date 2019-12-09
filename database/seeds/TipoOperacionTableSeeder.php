<?php

use Illuminate\Database\Seeder;
use App\TipoOperacion;

class TipoOperacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoOperacion::create([
            'name'              => 'venta interna',
            'codigo_sunat'      => '0101'
        ]);
    }
}
