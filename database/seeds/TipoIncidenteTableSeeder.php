<?php

use Illuminate\Database\Seeder;
use App\TipoIncidente;

class TipoIncidenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoIncidente::create([
            'name'          => 'Miembro Honorario'
        ]);
        TipoIncidente::create([
            'name'          => 'Miembro Vitalicio'
        ]);
        TipoIncidente::create([
            'name'          => 'Nombramientos'
        ]);
        TipoIncidente::create([
            'name'          => 'Salida del Pais'
        ]);
        TipoIncidente::create([
            'name'          => 'Retornos al Pais'
        ]);
        TipoIncidente::create([
            'name'          => 'Condecoraciones'
        ]);
        TipoIncidente::create([
            'name'          => 'Fallecimientos'
        ]);
        TipoIncidente::create([
            'name'          => 'Donaciones'
        ]);
        TipoIncidente::create([
            'name'          => 'Multa por Elecciones'
        ]);
    }
}
