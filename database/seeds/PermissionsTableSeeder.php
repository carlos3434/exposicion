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
        Permission::create([
            'name'          => 'Navegar Secretaria',
            'slug'          => 'NAV_SECRETARY',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Navegar Contabilidad',
            'slug'          => 'NAV_ACCOUNTANT',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Navegar Elecciones',
            'slug'          => 'NAV_ELECTIONS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Navegar Reportes',
            'slug'          => 'NAV_REPORTS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Creación Colegiado',
            'slug'          => 'CREATE_COLEGIADO',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Navegar Colegiado',
            'slug'          => 'READ_COLEGIADO',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Edicion Colegiado',
            'slug'          => 'UPDATE_COLEGIADO',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Ver Colegiado',
            'slug'          => 'DETAIL_COLEGIADO',
            'description'   => '',
        ]);
        //Editar campos numero colegiado y fecha de registro
        Permission::create([
            'name'          => 'Edicion Colegiado Num Colegiado, Fecha Registro',
            'slug'          => 'UPDATE_COLEGIADO_ESP',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Exportar Colegiado',
            'slug'          => 'EXPORT_COLEGIADO',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Creación Diplomas',
            'slug'          => 'CREATE_DIPLOMAS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'ver Diplomas',
            'slug'          => 'READ_DIPLOMAS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Eliminar Diplomas',
            'slug'          => 'DELETE_DIPLOMAS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Creación Incidentes',
            'slug'          => 'CREATE_INDICENTES',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'ver Incidentes',
            'slug'          => 'READ_INCIDENTES',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Eliminar Incidentes',
            'slug'          => 'DELETE_INCIDENTES',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Eliminar Translados',
            'slug'          => 'CREATE_TRASLADOS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Ver Translados',
            'slug'          => 'READ_TRASLADOS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Eliminar Translados',
            'slug'          => 'DELETE_TRASLADOS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Creación Licencias',
            'slug'          => 'CREATE_LICENCIAS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Ver Licencias',
            'slug'          => 'READ_LICENCIAS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Eliminar Licencias',
            'slug'          => 'DELETE_LICENCIAS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Ver Habilidad',
            'slug'          => 'DETAIL_HABILIDAD',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Ver Cuentas',
            'slug'          => 'DETAIL_CUENTAS',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Creación Procesos',
            'slug'          => 'CREATE_PROCESO',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Ver Procesos',
            'slug'          => 'READ_PROCESO',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Eliminar Procesos',
            'slug'          => 'DELETE_PROCESO',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Creación Apelaciones',
            'slug'          => 'CREATE_APELACIONES',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Eliminar Apelaciones',
            'slug'          => 'READ_APELACIONES',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Eliminar Apelaciones',
            'slug'          => 'DELETE_APELACIONES',
            'description'   => '',
        ]);

        Permission::create([
            'name'          => 'Validar Inscripcion',//Seretaria 46
            'slug'          => 'UPDATE_COLEGIADO_STEP_1',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Solicitar Colegiatura',//departamental 47
            'slug'          => 'UPDATE_COLEGIADO_STEP_2',//
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Resolver Solicitud Colegiatura',//departamental 48
            'slug'          => 'UPDATE_COLEGIADO_STEP_3',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Validadar Solicitud Colegiatura',//Seretaria 49 
            'slug'          => 'UPDATE_COLEGIADO_STEP_4',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Generar Carnet',//departamental 50 
            'slug'          => 'UPDATE_COLEGIADO_STEP_5',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Programar Juramentacion',//departamental 51
            'slug'          => 'UPDATE_COLEGIADO_STEP_6',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Validar Juramentacion',//departamental 52
            'slug'          => 'UPDATE_COLEGIADO_STEP_7',
            'description'   => '',
        ]);

        Permission::create([
            'name'          => 'Ver Beneficiario',
            'slug'          => 'READ_BENEFICIARIO',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Creación Beneficiario',
            'slug'          => 'CREATE_BENEFICIARIO',
            'description'   => '',
        ]);
        Permission::create([
            'name'          => 'Eliminar Beneficiario',
            'slug'          => 'DELETE_BENEFICIARIO',
            'description'   => '',
        ]);
        //permission_user

    }
}
