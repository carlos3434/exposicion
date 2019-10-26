<?php

use Illuminate\Database\Seeder;
use App\Sancion;

class SancionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sancion::create([
            'name'          => 'Expulsión'
        ]);
        Sancion::create([
            'name'          => 'Suspensión'
        ]);
        Sancion::create([
            'name'          => 'Multa'
        ]);
        Sancion::create([
            'name'          => 'Amonestación'
        ]);
    }
}
