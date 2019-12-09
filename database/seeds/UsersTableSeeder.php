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
                        ->whereNotIn('id',[1,46,47,48,49,50,51,52])
                        ->first('ids');
        $permissionsArray = explode(',',$permissions->ids);

        $user = User::create([
            'name'              => 'Admin',
            'departamento_id'   => 2533,
            'email'             => 'admin@gmail.com',
            'password'          => bcrypt(12345678),
        ]);

        $user->roles()->sync( [1] );

        $user = User::create([
            'name'              => 'Secretaria',
            'departamento_id'   => 2533,
            'email'             => 'secretaria@gmail.com',
            'password'          => bcrypt(12345678),
        ]);

        $user->roles()->sync( [2] );
        $user->permissions()->sync( array_merge($permissionsArray,[46,49] ) );

        $user = User::create([
            'name'              => 'Contador',
            'departamento_id'   => 2533,
            'email'             => 'contador@gmail.com',
            'password'          => bcrypt(12345678),
        ]);

        $user->roles()->sync( [3] );
        $user->permissions()->sync( $permissionsArray );

        //Amazonas
        $user = User::create([
            'name'              => 'Amazonas',
            'departamento_id'   => 2534,
            'email'             => 'amazonas@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Ancash
        $user = User::create([
            'name'              => 'Ancash',
            'departamento_id'   => 2625,
            'email'             => 'ancash@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Apurimac
        $user = User::create([
            'name'              => 'Apurimac',
            'departamento_id'   => 2812,
            'email'             => 'apurimac@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Arequipa
        $user = User::create([
            'name'              => 'Arequipa',
            'departamento_id'   => 2900,
            'email'             => 'arequipa@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Ayacucho
        $user = User::create([
            'name'              => 'Ayacucho',
            'departamento_id'   => 3020,
            'email'             => 'ayacucho@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Cajamarca
        $user = User::create([
            'name'              => 'Cajamarca',
            'departamento_id'   => 3143,
            'email'             => 'cajamarca@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Cusco
        $user = User::create([
            'name'              => 'Cusco',
            'departamento_id'   => 3292,
            'email'             => 'cusco@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Huancavelica
        $user = User::create([
            'name'              => 'Huancavelica',
            'departamento_id'   => 3414,
            'email'             => 'huancavelica@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        $user = User::create([
            'name'              => 'Huanuco',
            'departamento_id'   => 3518,
            'email'             => 'huanuco@gmail.com',
            'password'          => bcrypt(12345678)
        ]);
        //Ica
        $user = User::create([
            'name'              => 'Ica',
            'departamento_id'   => 3606,
            'email'             => 'ica@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Junin
        $user = User::create([
            'name'              => 'Junin',
            'departamento_id'   => 3655,
            'email'             => 'junin@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //La Libertad
        $user = User::create([
            'name'              => 'La Libertad',
            'departamento_id'   => 3788,
            'email'             => 'lalibertad@gmail.com',
            'password'          => bcrypt(12345678),
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Lambayeque
        $user = User::create([
            'name'              => 'Lambayeque',
            'departamento_id'   => 3884,
            'email'             => 'lambayeque@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        $user = User::create([
            'name'              => 'Lima',
            'departamento_id'   => 3926,
            'email'             => 'lima@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Loreto
        $user = User::create([
            'name'              => 'Loreto',
            'departamento_id'   => 4108,
            'email'             => 'loreto@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Madre
        $user = User::create([
            'name'              => 'Madre de Dios',
            'departamento_id'   => 4165,
            'email'             => 'madrededios@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Moquegua
        $user = User::create([
            'name'              => 'Moquegua',
            'departamento_id'   => 4180,
            'email'             => 'moquegua@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Pasco
        $user = User::create([
            'name'              => 'Pasco',
            'departamento_id'   => 4204,
            'email'             => 'pasco@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Piura
        $user = User::create([
            'name'              => 'Piura',
            'departamento_id'   => 4236,
            'email'             => 'piura@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Puno
        $user = User::create([
            'name'              => 'Puno',
            'departamento_id'   => 4309,
            'email'             => 'puno@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //San
        $user = User::create([
            'name'              => 'San Martin',
            'departamento_id'   => 4431,
            'email'             => 'sanmartin@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Tacna
        $user = User::create([
            'name'              => 'Tacna',
            'departamento_id'   => 4519,
            'email'             => 'tacna@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Tumbes
        $user = User::create([
            'name'              => 'Tumbes',
            'departamento_id'   => 4551,
            'email'             => 'tumbes@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

        //Ucayali
        $user = User::create([
            'name'              => 'Ucayali',
            'departamento_id'   => 4567,
            'email'             => 'ucayali@gmail.com',
            'password'          => bcrypt(12345678)
        ]);

        $user->roles()->sync( [4] );
        $user->permissions()->sync( array_merge($permissionsArray,[47,48,50,51,52] ) );

    }
}
