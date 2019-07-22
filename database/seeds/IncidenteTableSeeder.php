<?php

use Illuminate\Database\Seeder;
use App\Incidente;

class IncidenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(1);
        Incidente::create([
            'fecha_registro'        => '2019-07-17',
            'descripcion'           => 'primera sancion',
            'documento'             => 'LRS: 2017-124578',
            'tipo_incidente_id'     => 1,
            'persona_id'            => 1
        ]);
        Incidente::create([
            'fecha_registro'        => '2019-07-17',
            'descripcion'           => 'primera sancion',
            'documento'             => 'LRS: 2017-124578',
            'tipo_incidente_id'     => 2,
            'persona_id'            => 1
        ]);
        Incidente::create([
            'fecha_registro'        => '2019-07-17',
            'descripcion'           => 'primera sancion',
            'documento'             => 'LRS: 2017-124578',
            'tipo_incidente_id'     => 3,
            'persona_id'            => 1
        ]);
    }
}
