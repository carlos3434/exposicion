<?php

use Illuminate\Database\Seeder;
use App\User;
use Caffeinated\Shinobi\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisions
        $permissions = \DB::table('permissions')
                        ->select( \DB::raw("group_concat(id) as ids") )
                        ->whereNotIn('id',[47,48,51,52])
                        ->first('ids');
        $permissionsSecretaria = explode(',',$permissions->ids);

        $permissions = \DB::table('permissions')
                        ->select( \DB::raw("group_concat(id) as ids") )
                        ->where('id','>',15)
                        ->whereNotIn('id',[46,47,48,49,50,51,52])
                        ->first('ids');
        $permissionsContador = explode(',',$permissions->ids);

        $permissions = \DB::table('permissions')
                        ->select( \DB::raw("group_concat(id) as ids") )
                        ->where('id','>',15)
                        ->whereNotIn('id',[46,49,50])
                        //->whereNotIn('id',[17])//nav CONTABILIDAD
                        ->whereNotIn('id',[18])//nav ELECCIONES
                        ->whereNotIn('id',[19])//nav Reporteria
                        ->whereNotIn('id',[53])//ver beneficiarios
                        ->first('ids');
        $permissionsDepartamental = explode(',',$permissions->ids);



        $user = User::create([
            'name'              => 'Admin',
            'departamento_id'   => 2533,
            'email'             => 'admin@gmail.com',
            'password'          => bcrypt(1234567890),
        ]);

        $user->roles()->sync( [1] );

        $user = User::create([
            'name'              => 'Secretaria',
            'departamento_id'   => 2533,
            'email'             => 'secretaria@gmail.com',
            'password'          => bcrypt(12345678),
        ]);

        $user->roles()->sync( [2] );
        $user->permissions()->sync( $permissionsSecretaria );

        $user = User::create([
            'name'              => 'Contador',
            'departamento_id'   => 2533,
            'email'             => 'contador@gmail.com',
            'password'          => bcrypt(12345678),
        ]);

        $user->roles()->sync( [3] );
        $user->permissions()->sync( $permissionsContador );

        //Amazonas
        $user = User::create([
            'name'              => 'Amazonas',
            'departamento_id'   => 2534,
            'email'             => 'amazonas@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Ancash
        $user = User::create([
            'name'              => 'Ancash',
            'departamento_id'   => 2625,
            'email'             => 'ancash@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Apurimac
        $user = User::create([
            'name'              => 'Apurimac',
            'departamento_id'   => 2812,
            'email'             => 'apurimac@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Arequipa
        $user = User::create([
            'name'              => 'Arequipa',
            'departamento_id'   => 2900,
            'email'             => 'arequipa@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Ayacucho
        $user = User::create([
            'name'              => 'Ayacucho',
            'departamento_id'   => 3020,
            'email'             => 'ayacucho@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Cajamarca
        $user = User::create([
            'name'              => 'Cajamarca',
            'departamento_id'   => 3143,
            'email'             => 'cajamarca@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Cusco
        $user = User::create([
            'name'              => 'Cusco',
            'departamento_id'   => 3292,
            'email'             => 'cusco@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Huancavelica
        $user = User::create([
            'name'              => 'Huancavelica',
            'departamento_id'   => 3414,
            'email'             => 'huancavelica@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        $user = User::create([
            'name'              => 'Huanuco',
            'departamento_id'   => 3518,
            'email'             => 'huanuco@gmail.com',
            'password'          => bcrypt(12345678)
        ]);
        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );
        //Ica
        $user = User::create([
            'name'              => 'Ica',
            'departamento_id'   => 3606,
            'email'             => 'ica@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Junin
        $user = User::create([
            'name'              => 'Junin',
            'departamento_id'   => 3655,
            'email'             => 'junin@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //La Libertad
        $user = User::create([
            'name'              => 'La Libertad',
            'departamento_id'   => 3788,
            'email'             => 'lalibertad@gmail.com',
            'password'          => bcrypt(12345678),
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Lambayeque
        $user = User::create([
            'name'              => 'Lambayeque',
            'departamento_id'   => 3884,
            'email'             => 'lambayeque@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        $user = User::create([
            'name'              => 'Lima',
            'departamento_id'   => 3926,
            'email'             => 'lima@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Loreto
        $user = User::create([
            'name'              => 'Loreto',
            'departamento_id'   => 4108,
            'email'             => 'loreto@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Madre
        $user = User::create([
            'name'              => 'Madre de Dios',
            'departamento_id'   => 4165,
            'email'             => 'madrededios@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Moquegua
        $user = User::create([
            'name'              => 'Moquegua',
            'departamento_id'   => 4180,
            'email'             => 'moquegua@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Pasco
        $user = User::create([
            'name'              => 'Pasco',
            'departamento_id'   => 4204,
            'email'             => 'pasco@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Piura
        $user = User::create([
            'name'              => 'Piura',
            'departamento_id'   => 4236,
            'email'             => 'piura@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Puno
        $user = User::create([
            'name'              => 'Puno',
            'departamento_id'   => 4309,
            'email'             => 'puno@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //San
        $user = User::create([
            'name'              => 'San Martin',
            'departamento_id'   => 4431,
            'email'             => 'sanmartin@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Tacna
        $user = User::create([
            'name'              => 'Tacna',
            'departamento_id'   => 4519,
            'email'             => 'tacna@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Tumbes
        $user = User::create([
            'name'              => 'Tumbes',
            'departamento_id'   => 4551,
            'email'             => 'tumbes@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

        //Ucayali
        $user = User::create([
            'name'              => 'Ucayali',
            'departamento_id'   => 4567,
            'email'             => 'ucayali@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( $permissionsDepartamental );

    }
}
