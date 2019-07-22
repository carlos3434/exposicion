<?php

use Illuminate\Database\Seeder;
use App\Apelacion;

class ApelacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(1);
        Apelacion::create([
            'fecha_registro'        => '2019-07-17',
            'resolucion'                => 'RES 101010',
            'persona_id'                => 1,
            'is_titular'                => false,
            'representanteNombres'      => 'juan carlos',
            'representanteApellidoPaterno'  => 'rojas',
            'representanteApellidoMaterno'     => 'toralva',
            'documento_id'              => 1
        ]);
        Apelacion::create([
            'fecha_registro'        => '2019-07-17',
            'resolucion'                => 'RES 101010',
            'persona_id'                => 1,
            'is_titular'                => false,
            'representanteNombres'      => 'juan carlos',
            'representanteApellidoPaterno'  => 'rojas',
            'representanteApellidoMaterno'     => 'toralva',
            'documento_id'              => 1
        ]);
        Apelacion::create([
            'fecha_registro'        => '2019-07-17',
            'resolucion'                => 'RES 101010',
            'persona_id'                => 1,
            'is_titular'                => false,
            'representanteNombres'      => 'juan carlos',
            'representanteApellidoPaterno'  => 'rojas',
            'representanteApellidoMaterno'     => 'toralva',
            'documento_id'              => 1
        ]);
        Apelacion::create([
            'fecha_registro'        => '2019-07-17',
            'resolucion'                => 'RES 101010',
            'persona_id'                => 1,
            'is_titular'                => false,
            'representanteNombres'      => 'juan carlos',
            'representanteApellidoPaterno'  => 'rojas',
            'representanteApellidoMaterno'     => 'toralva',
            'documento_id'              => 1
        ]);
        Apelacion::create([
            'fecha_registro'        => '2019-07-17',
            'resolucion'                => 'RES 101010',
            'persona_id'                => 1,
            'is_titular'                => false,
            'representanteNombres'      => 'juan carlos',
            'representanteApellidoPaterno'  => 'rojas',
            'representanteApellidoMaterno'     => 'toralva',
            'documento_id'              => 1
        ]);
        Apelacion::create([
            'fecha_registro'        => '2019-07-17',
            'resolucion'                => 'RES 101010',
            'persona_id'                => 1,
            'is_titular'                => false,
            'representanteNombres'      => 'juan carlos',
            'representanteApellidoPaterno'  => 'rojas',
            'representanteApellidoMaterno'     => 'toralva',
            'documento_id'              => 1
        ]);
    }
}
