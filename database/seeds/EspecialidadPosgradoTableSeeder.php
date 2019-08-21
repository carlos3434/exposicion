<?php

use Illuminate\Database\Seeder;
use App\EspecialidadPosgrado;
class EspecialidadPosgradoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EspecialidadPosgrado::create([
            'name'      => 'Animales de compañía'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Animales de producción'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Animales de competencia y trabajo'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Animales silvestres'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Animales para docencia e investigación'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Animales acuáticos'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Docencia'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Salud pública'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Salud ambiental'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Gestión pública y privada'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Peritaje'
        ]);
        EspecialidadPosgrado::create([
            'name'      => 'Investigación Criminalística'
        ]);
    }
}
