<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AreaEjercicioProfesionalTableSeeder::class);
         $this->call(CargoPostulanteTableSeeder::class);
         $this->call(EspecialidadPosgradoTableSeeder::class);
         $this->call(EstadoCivilTableSeeder::class);
         $this->call(EstadoCuentaSistemaTableSeeder::class);
         $this->call(EstadoRegistroColegiadoTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);
         $this->call(TipoDocumentoIdentidadTableSeeder::class);
         $this->call(TipoDocumentoPagoTableSeeder::class);
         $this->call(TipoGastoTableSeeder::class);
         $this->call(TipoIncidenteTableSeeder::class);
         $this->call(TipoProcesoDisciplinarioTableSeeder::class);
         $this->call(UniversidadTableSeeder::class);
         $this->call(SancionsTableSeeder::class);
    }
}
