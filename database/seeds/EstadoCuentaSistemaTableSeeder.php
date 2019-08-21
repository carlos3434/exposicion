<?php

use Illuminate\Database\Seeder;
use App\EstadoCuentaSistema;
class EstadoCuentaSistemaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoCuentaSistema::create([
            'name'        => 'Activo',
        ]);
        EstadoCuentaSistema::create([
            'name'        => 'Inactivo',
        ]);
    }
}
