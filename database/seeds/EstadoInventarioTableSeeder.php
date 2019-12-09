<?php

use Illuminate\Database\Seeder;
use App\EstadoInventario;

class EstadoInventarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoInventario::create([
            'name'      => 'Nuevo',
        ]);
        EstadoInventario::create([
            'name'      => 'Antiguo',
        ]);
    }
}
