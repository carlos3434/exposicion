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
            'name'          => 'Doc Trib No Dom Sin Ruc'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => '1',
            'name'          => 'Documento Nacional de Identidad'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => '4',
            'name'          => 'Carnet de Extranjeria'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => '6',
            'name'          => 'Registro Unico de Contribuyentes'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => '7',
            'name'          => 'Pasaporte'
        ]);
        TipoDocumentoIdentidad::create([
            'codigo_sunat'  => 'A',
            'name'          => 'Cedula diplomatica de identidad'
        ]);
    }
}
