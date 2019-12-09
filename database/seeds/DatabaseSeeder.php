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
        //crear ubogeo y universidades
        
        \DB::unprepared(file_get_contents('database/seeds/ubigeos.sql'));
        \DB::unprepared(file_get_contents('database/seeds/universidades.sql'));
        \DB::unprepared(file_get_contents('database/seeds/empresa.sql'));

        $this->call('TipoConceptoTableSeeder');
        $this->call('TipoInventarioTableSeeder');
        $this->call('TipoDocumentoIdentidadTableSeeder');
        $this->call('TipoDocumentoPagoTableSeeder');
        $this->call('TipoGastoTableSeeder');
        $this->call('TipoIncidenteTableSeeder');
        $this->call('TipoProcesoDisciplinarioTableSeeder');
        $this->call('TipoNotaTableSeeder');
        $this->call('TipoOperacionTableSeeder');
        $this->call('TipoPresupuestoTableSeeder');
        $this->call('TipoRendicionTableSeeder');

        $this->call('EstadoInventarioTableSeeder');
        $this->call('EstadoPagoTableSeeder');
        $this->call('EspecialidadPosgradoTableSeeder');
        $this->call('EstadoCivilTableSeeder');
        $this->call('EstadoCuentaSistemaTableSeeder');
        $this->call('EstadoRegistroColegiadoTableSeeder');

        $this->call('ConceptosTableSeeder');
        $this->call('SerieTableSeeder');
        $this->call('AreaEjercicioProfesionalTableSeeder');
        $this->call('CargoPostulanteTableSeeder');
        $this->call('SancionsTableSeeder');

        $this->call('PermissionsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('UsersTableSeeder');

    }
}
