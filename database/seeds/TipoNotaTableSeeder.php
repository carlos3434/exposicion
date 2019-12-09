<?php

use Illuminate\Database\Seeder;
use App\TipoNota;

class TipoNotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoNota::create([
            'name'              => 'Anulación de la operación',
            'codigo_sunat'      => '01',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Anulación por error en el RUC',
            'codigo_sunat'      => '02',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Corrección por error en la descripción',
            'codigo_sunat'      => '03',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Descuento global',
            'codigo_sunat'      => '04',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Descuento por ítem',
            'codigo_sunat'      => '05',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Devolución total',
            'codigo_sunat'      => '06',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Devolución por ítem',
            'codigo_sunat'      => '07',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Bonificación',
            'codigo_sunat'      => '08',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Disminución en el valor',
            'codigo_sunat'      => '09',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Otros Conceptos',
            'codigo_sunat'      => '10',
            'tipo'              => 0,
        ]);
        TipoNota::create([
            'name'              => 'Aumento en el valor',
            'codigo_sunat'      => '01',
            'tipo'              => 1,
        ]);
        TipoNota::create([
            'name'              => 'Penalidades/ otros conceptos',
            'codigo_sunat'      => '02',
            'tipo'              => 1,
        ]);
        TipoNota::create([
            'name'              => 'Otros Conceptos ',
            'codigo_sunat'      => '03',
            'tipo'              => 1,
        ]);
    }
}
