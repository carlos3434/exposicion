<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'READ_USER',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'DETAIL_USER',
            'description'   => 'Ve en detalle cada usuario del sistema',
        ]);
        Permission::create([
            'name'          => 'Creación de usuarios',
            'slug'          => 'CREATE_USER',
            'description'   => 'Podría crear nuevos usuario en el sistema',
        ]);
        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'UPDATE_USER',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);
        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'DELETE_USER',
            'description'   => 'Podría eliminar cualquier usuario del sistema',
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'READ_ROLE',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'DETAIL_ROLE',
            'description'   => 'Ve en detalle cada rol del sistema',
        ]);
        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'CREATE_ROLE',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);
        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'UPDATE_ROLE',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);
        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'DELETE_ROLE',
            'description'   => 'Podría eliminar cualquier rol del sistema',
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar permisos',
            'slug'          => 'READ_PERMISSION',
            'description'   => 'Lista y navega todos los permisos del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un permisos',
            'slug'          => 'DETAIL_PERMISSION',
            'description'   => 'Ve en detalle cada permisos del sistema',
        ]);
        Permission::create([
            'name'          => 'Creación de permisos',
            'slug'          => 'CREATE_PERMISSION',
            'description'   => 'Podría crear nuevos permisos en el sistema',
        ]);
        Permission::create([
            'name'          => 'Edición de permisos',
            'slug'          => 'UPDATE_PERMISSION',
            'description'   => 'Podría editar cualquier dato de un permisos del sistema',
        ]);
        Permission::create([
            'name'          => 'Eliminar permisos',
            'slug'          => 'DELETE_PERMISSION',
            'description'   => 'Podría eliminar cualquier permisos del sistema',
        ]);
    }
}
