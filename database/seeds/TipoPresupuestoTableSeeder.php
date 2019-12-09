<?php

use Illuminate\Database\Seeder;
use App\TipoPresupuesto;

class TipoPresupuestoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPresupuesto::create([
            'name'              => 'GASTOS DE PERSONAL',
        ]);
        TipoPresupuesto::create([
            'name'              => 'TELEFONO',
        ]);
        TipoPresupuesto::create([
            'name'              => 'HONORARIOS PROFESIONALES',
        ]);
        TipoPresupuesto::create([
            'name'              => 'MANTENIMIENTO Y REPARACION',
        ]);

        TipoPresupuesto::create([
            'name'              => 'AGUA',
        ]);
        TipoPresupuesto::create([
            'name'              => 'OTROS SERVICIOS',
        ]);
        TipoPresupuesto::create([
            'name'              => 'OTROS GASTOS',
        ]);
        TipoPresupuesto::create([
            'name'              => 'TRIBUTOS',
        ]);
    }
}
