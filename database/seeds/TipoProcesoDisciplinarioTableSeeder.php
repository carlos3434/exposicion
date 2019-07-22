<?php

use Illuminate\Database\Seeder;
use App\TipoProcesoDisciplinario;

class TipoProcesoDisciplinarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        TipoProcesoDisciplinario::create([
            'name'          => 'Infraccion Reglamento'
        ]);
        TipoProcesoDisciplinario::create([
            'name'          => 'Infraccion Etica'
        ]);
    }
}
