<?php

use Illuminate\Database\Seeder;
use App\TipoDocumentoIdentidad;
class TipoDocumentoIdentidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => '0',
            'name'          => 'Doc Trib No Dom Sin Ruc',
            'alias'         => 'Sin RUC'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => '1',
            'name'          => 'Documento Nacional de Identidad',
            'alias'         => 'DNI'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => '4',
            'name'          => 'Carnet de Extranjeria',
            'alias'         => 'Carnet Extranjeria'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => '6',
            'name'          => 'Registro Unico de Contribuyentes',
            'alias'         => 'RUC'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => '7',
            'name'          => 'Pasaporte',
            'alias'         => 'Pasaporte'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => 'A',
            'name'          => 'Cedula diplomatica de identidad',
            'alias'         => 'CEDULA'
        ]);
    }
}
