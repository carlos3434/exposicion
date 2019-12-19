<?php

use Illuminate\Database\Seeder;
use App\CargoPostulante;

class CargoPostulanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CargoPostulante::create([
            'name'        => 'Decano',
        ]);
        CargoPostulante::create([
            'name'        => 'Vicedecano',
        ]);
        CargoPostulante::create([
            'name'        => 'Vocal',
        ]);
        CargoPostulante::create([
            'name'        => 'Secretario',
        ]);
        CargoPostulante::create([
            'name'        => 'Tesorero',
        ]);

        CargoPostulante::create([
            'name'        => 'Presidente',
        ]);
        CargoPostulante::create([
            'name'        => 'vice presidente',
        ]);
        CargoPostulante::create([
            'name'        => 'Secretario',
        ]);
        CargoPostulante::create([
            'name'        => 'tesorero',
        ]);
        CargoPostulante::create([
            'name'        => 'vocal',
        ]);
    }
}
