<?php

use Illuminate\Database\Seeder;
use App\Serie;

class SerieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Serie::create([
            'name'                  => '001',//Amazonas
            'departamento_id'       => 2534,
        ]);
        Serie::create([
            'name'                  => '002',//Ancash
            'departamento_id'       => 2625,
        ]);
        Serie::create([
            'name'                  => '003',//Apurimac
            'departamento_id'       => 2812,
        ]);
        Serie::create([
            'name'                  => '004',//Arequipa
            'departamento_id'       => 2900,
        ]);
        Serie::create([
            'name'                  => '005',//Ayacucho
            'departamento_id'       => 3020,
        ]);
        Serie::create([
            'name'                  => '006',//Cajamarca
            'departamento_id'       => 3143,
        ]);
        Serie::create([
            'name'                  => '007',//Cusco
            'departamento_id'       => 3292,
        ]);
        Serie::create([
            'name'                  => '008',//Huancavelica
            'departamento_id'       => 3414,
        ]);
        Serie::create([
            'name'                  => '009',//Huanuco
            'departamento_id'       => 3518,
        ]);
        Serie::create([
            'name'                  => '010',//Ica
            'departamento_id'       => 3606,
        ]);
        Serie::create([
            'name'                  => '011',//Junin
            'departamento_id'       => 3655,
        ]);
        Serie::create([
            'name'                  => '012',//La Libertad
            'departamento_id'       => 3788,
        ]);
        Serie::create([
            'name'                  => '013',//Lambayeque
            'departamento_id'       => 3884,
        ]);
        Serie::create([
            'name'                  => '014',//Lima
            'departamento_id'       => 3926,
        ]);
        Serie::create([
            'name'                  => '015',//Loreto
            'departamento_id'       => 4108,
        ]);
        Serie::create([
            'name'                  => '016',//Madre de Dios
            'departamento_id'       => 4165,
        ]);
        Serie::create([
            'name'                  => '017',//Moquegua
            'departamento_id'       => 4180,
        ]);
        Serie::create([
            'name'                  => '018',//Pasco
            'departamento_id'       => 4204,
        ]);
        Serie::create([
            'name'                  => '019',//Piura
            'departamento_id'       => 4236,
        ]);
        Serie::create([
            'name'                  => '020',//Puno
            'departamento_id'       => 4309,
        ]);
        Serie::create([
            'name'                  => '021',//San Martin
            'departamento_id'       => 4431,
        ]);
        Serie::create([
            'name'                  => '022',//Tacna
            'departamento_id'       => 4519,
        ]);
        Serie::create([
            'name'                  => '023',//Tumbes
            'departamento_id'       => 4551,
        ]);
        Serie::create([
            'name'                  => '024',//Ucayali
            'departamento_id'       => 4567,
        ]);
    }
}
