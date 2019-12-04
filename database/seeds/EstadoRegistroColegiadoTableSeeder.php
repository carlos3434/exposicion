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
            'name'        => 'Inscrito',
        ]);
        EstadoRegistroColegiado::create([
            'name'        => 'Solicitud Pendiente',
        ]);
        EstadoRegistroColegiado::create([
            'name'        => 'Solicitud Resuelta',
        ]);
        EstadoRegistroColegiado::create([
            'name'        => 'Solicitud Validada',
        ]);
        EstadoRegistroColegiado::create([
            'name'        => 'Carnet Generado',
        ]);
        EstadoRegistroColegiado::create([
            'name'        => 'Programar Juramentacion',
        ]);
        EstadoRegistroColegiado::create([
            'name'        => 'Validar Juramentacion',
        ]);
    }
}
