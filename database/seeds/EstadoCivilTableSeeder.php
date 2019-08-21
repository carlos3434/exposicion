<?php

use Illuminate\Database\Seeder;
use App\EstadoCivil;

class EstadoCivilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoCivil::create([
            'name'      => 'soltero',
            'sigla'     => 'S',
        ]);
        EstadoCivil::create([
            'name'      => 'casado',
            'sigla'     => 'C',
        ]);
        EstadoCivil::create([
            'name'      => 'viudo',
            'sigla'     => 'V',
        ]);
        EstadoCivil::create([
            'name'      => 'divorciado',
            'sigla'     => 'D',
        ]);
    }
}
