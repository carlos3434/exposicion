<?php

use Illuminate\Database\Seeder;
use App\TipoGasto;
class TipoGastoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        TipoGasto::create([
            'name'          => 'Hospedaje'
        ]);
        TipoGasto::create([
            'name'          => 'Alimentación'
        ]);
        TipoGasto::create([
            'name'          => 'Movilidad'
        ]);
        TipoGasto::create([
            'name'          => 'Gastos sin sustento'
        ]);
    }
}
