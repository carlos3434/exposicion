<?php

use Illuminate\Database\Seeder;
use App\Comite;

class ComiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(1);
        Comite::create([
            'fecha_registro'        => '2019-07-17',
            'observacion'           => 'observacion a',
            'cargo_postulante_id'   => 1,
            'persona_id'            => 1,
        ]);
        Comite::create([
            'fecha_registro'        => '2019-07-17',
            'observacion'           => 'observacion b',
            'cargo_postulante_id'   => 1,
            'persona_id'            => 1,
        ]);
        Comite::create([
            'fecha_registro'        => '2019-07-17',
            'observacion'           => 'observacion c',
            'cargo_postulante_id'   => 1,
            'persona_id'            => 1,
        ]);
    }
}
