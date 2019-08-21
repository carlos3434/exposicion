<?php

use Illuminate\Database\Seeder;
use App\AreaEjercicioProfesional;
class AreaEjercicioProfesionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AreaEjercicioProfesional::create([
            'name'      => 'Animales de compañía'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Animales de producción'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Animales de competencia y trabajo'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Animales silvestres'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Animales para docencia e investigación'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Animales acuáticos'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Docencia'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Salud pública'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Salud ambiental'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Gestión pública y privada'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Peritaje'
        ]);
        AreaEjercicioProfesional::create([
            'name'      => 'Investigación Criminalística'
        ]);
    }
}
