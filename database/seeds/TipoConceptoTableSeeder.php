<?php

use Illuminate\Database\Seeder;
use App\TipoConcepto;
class TipoConceptoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        TipoConcepto::create([
            'name'          => 'INGRESOS',
            'tipo'          => 1,
            'order'         => 1
        ]);
        TipoConcepto::create([
            'name'          => 'GASTOS DE PERSONAL',
            'tipo'          => 1,
            'order'         => 1
        ]);
        TipoConcepto::create([
            'name'          => 'TELEFONO',
            'tipo'          => 1,
            'order'         => 2
        ]);
        TipoConcepto::create([
            'name'          => 'HONORARIOS PROFESIONALES',
            'tipo'          => 1,
            'order'         => 3
        ]);
        TipoConcepto::create([
            'name'          => 'MANTENIMIENTO Y REPARACION',
            'tipo'          => 1,
            'order'         => 4
        ]);
        TipoConcepto::create([
            'name'          => 'AGUA',
            'tipo'          => 1,
            'order'         => 5
        ]);
        TipoConcepto::create([
            'name'          => 'OTROS SERVICIOS',
            'tipo'          => 1,
            'order'         => 6
        ]);
        TipoConcepto::create([
            'name'          => 'OTROS GASTOS',
            'tipo'          => 1,
            'order'         => 7
        ]);
        TipoConcepto::create([
            'name'          => 'TRIBUTOS',
            'tipo'          => 1,
            'order'         => 8
        ]);
        TipoConcepto::create([
            'name'          => 'MULTAS',
            'tipo'          => 1,
            'order'         => 9
        ]);
    }
}
