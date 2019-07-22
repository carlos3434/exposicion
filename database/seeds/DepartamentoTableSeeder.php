<?php

use Illuminate\Database\Seeder;
use App\Departamento;

class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create(['name' => 'Amazonas']);
        Departamento::create(['name' => 'Áncash']);
        Departamento::create(['name' => 'Apurímac']);
        Departamento::create(['name' => 'Arequipa']);
        Departamento::create(['name' => 'Ayacucho']);
        Departamento::create(['name' => 'Cajamarca']);
        Departamento::create(['name' => 'Cusco']);
        Departamento::create(['name' => 'Huancavelica']);
        Departamento::create(['name' => 'Huánuco']);
        Departamento::create(['name' => 'Ica']);
        Departamento::create(['name' => 'Junín']);
        Departamento::create(['name' => 'La Libertad']);
        Departamento::create(['name' => 'Lambayeque']);
        Departamento::create(['name' => 'Lima']);
        Departamento::create(['name' => 'Loreto']);
        Departamento::create(['name' => 'Madre de Dios']);
        Departamento::create(['name' => 'Moquegua']);
        Departamento::create(['name' => 'Pasco']);
        Departamento::create(['name' => 'Piura']);
        Departamento::create(['name' => 'Puno']);
        Departamento::create(['name' => 'San Martín']);
        Departamento::create(['name' => 'Tacna']);
        Departamento::create(['name' => 'Tumbes']);
        Departamento::create(['name' => 'Ucayali']);
    }
}
