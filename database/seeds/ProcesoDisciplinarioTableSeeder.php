<?php

use Illuminate\Database\Seeder;
use App\ProcesoDisciplinario;

class ProcesoDisciplinarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(1);
        ProcesoDisciplinario::create([
            'fecha_registro'        => '2019-07-17',
            'descripcion'           => 'primera sancion',
            'documento'             => 'LRS: 2017-124578',
            'persona_id'            => 1,
            'sancion_id'            => 1,
            'tipo_proceso_disciplinario_id'            => 1
        ]);

        ProcesoDisciplinario::create([
            'fecha_registro'        => '2019-07-17',
            'descripcion'           => 'primera sancion',
            'documento'             => 'LRS: 2017-124578',
            'persona_id'            => 1,
            'sancion_id'            => 1,
            'tipo_proceso_disciplinario_id'            => 1
        ]);

        ProcesoDisciplinario::create([
            'fecha_registro'        => '2019-07-17',
            'descripcion'           => 'primera sancion',
            'documento'             => 'LRS: 2017-124578',
            'persona_id'            => 1,
            'sancion_id'            => 1,
            'tipo_proceso_disciplinario_id'            => 1
        ]);
    }
}
