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
            'order'         => 1
        ]);
        TipoConcepto::create([
            'name'          => 'GASTOS DE PERSONAL',
            'order'         => 1
        ]);
        TipoConcepto::create([
            'name'          => 'TELEFONO',
            'order'         => 2
        ]);
        TipoConcepto::create([
            'name'          => 'HONORARIOS PROFESIONALES',
            'order'         => 3
        ]);
        TipoConcepto::create([
            'name'          => 'MANTENIMIENTO Y REPARACION',
            'order'         => 4
        ]);
        TipoConcepto::create([
            'name'          => 'AGUA',
            'order'         => 5
        ]);
        TipoConcepto::create([
            'name'          => 'OTROS SERVICIOS',
            'order'         => 6
        ]);
        TipoConcepto::create([
            'name'          => 'OTROS GASTOS',
            'order'         => 7
        ]);
        TipoConcepto::create([
            'name'          => 'TRIBUTOS',
            'order'         => 8
        ]);
        TipoConcepto::create([
            'name'          => 'MULTAS',
            'order'         => 9
        ]);
    }
}
