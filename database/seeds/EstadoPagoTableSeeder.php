<?php

use Illuminate\Database\Seeder;
use App\EstadoPago;

class EstadoPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoPago::create([
            'name'      => 'PENDIENTE',
        ]);
        EstadoPago::create([
            'name'      => 'COMPLETADO',
        ]);
        EstadoPago::create([
            'name'      => 'FRACCIONADO',
        ]);
        EstadoPago::create([
            'name'      => 'EXONERADO',
        ]);
        EstadoPago::create([
            'name'      => 'ELIMINADO',
        ]);
        EstadoPago::create([
            'name'      => 'ADELANTADO',
        ]);
    }
}
