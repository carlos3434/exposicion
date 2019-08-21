<?php

use Illuminate\Database\Seeder;
use App\EstadoRegistroColegiado;
class EstadoRegistroColegiadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoRegistroColegiado::create([
            'name'        => 'Nuevo',
        ]);
        EstadoRegistroColegiado::create([
            'name'        => 'Llegada en Fisico',
        ]);
        EstadoRegistroColegiado::create([
            'name'        => 'Validado',
        ]);
    }
}
