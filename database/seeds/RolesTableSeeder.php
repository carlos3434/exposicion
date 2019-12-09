<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'          => 'Admin',
            'slug'          => 'admin',
            'description'   => 'usuario administrador',
            'special'       => 'all-access',
        ]);
        Role::create([
            'name'          => 'Secretaria',
            'slug'          => 'secretaria',
            'description'   => 'usuario secretario'
        ]);
        Role::create([
            'name'          => 'Contador',
            'slug'          => 'contador',
            'description'   => 'usuario contador'
        ]);
        Role::create([
            'name'          => 'Departamental',
            'slug'          => 'departamental',
            'description'   => 'usuario departamental'
        ]);
    }
}
