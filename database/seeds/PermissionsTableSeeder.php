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
            'description'   => 'Lista y Navega en Secretaria',
        ]);
        Permission::create([
            'name'          => 'Navegar Contabilidad',
            'slug'          => 'NAV_ACCOUNTANT',
            'description'   => 'Lista y Navega en Contabilidad',
        ]);
        Permission::create([
            'name'          => 'Navegar Elecciones',
            'slug'          => 'NAV_ELECTIONS',
            'description'   => 'Lista y Navega en Elecciones',
        ]);
        Permission::create([
            'name'          => 'Navegar Reportes',
            'slug'          => 'NAV_REPORTS',
            'description'   => 'Lista y Navega en Reportes',
        ]);
        Permission::create([
            'name'          => 'Creación Colegiado',
            'slug'          => 'CREATE_COLEGIADO',
            'description'   => 'Podría crear nuevos Colegiados',
        ]);
        Permission::create([
            'name'          => 'Navegar Colegiado',
            'slug'          => 'READ_COLEGIADO',
            'description'   => 'Lista y Navega Colegiados',
        ]);
        Permission::create([
            'name'          => 'Edicion Colegiado',
            'slug'          => 'UPDATE_COLEGIADO',
            'description'   => 'Podria editar cualquier Colegiado',
        ]);
        Permission::create([
            'name'          => 'Ver Colegiado',
            'slug'          => 'DETAIL_COLEGIADO',
            'description'   => 'Ver detalle de un colegiado',
        ]);
        //Editar campos numero colegiado y fecha de registro
        Permission::create([
            'name'          => 'Edicion Colegiado Num Colegiado, Fecha Registro',
            'slug'          => 'UPDATE_COLEGIADO_ESP',
            'description'   => 'Poria editar Numero de Colegiado, Fecha Registro',
        ]);
        Permission::create([
            'name'          => 'Exportar Colegiado',
            'slug'          => 'EXPORT_COLEGIADO',
            'description'   => 'Podria Exportar Lista de Colegiados',
        ]);
        Permission::create([
            'name'          => 'Creación Diplomas',
            'slug'          => 'CREATE_DIPLOMAS',
            'description'   => 'Podria Crear Diplomas',
        ]);
        Permission::create([
            'name'          => 'ver Diplomas',
            'slug'          => 'READ_DIPLOMAS',
            'description'   => 'Lista y Navega Diplomas',
        ]);
        Permission::create([
            'name'          => 'Eliminar Diplomas',
            'slug'          => 'DELETE_DIPLOMAS',
            'description'   => 'Podria aliminar Diplomas',
        ]);
        Permission::create([
            'name'          => 'Creación Incidentes',
            'slug'          => 'CREATE_INCIDENTES',
            'description'   => 'Podria crear nuevos incidentes',
        ]);
        Permission::create([
            'name'          => 'ver Incidentes',
            'slug'          => 'READ_INCIDENTES',
            'description'   => 'Lista y navega Incidentes',
        ]);
        Permission::create([
            'name'          => 'Eliminar Incidentes',
            'slug'          => 'DELETE_INCIDENTES',
            'description'   => 'Podria eliminar Incidentes',
        ]);
        Permission::create([
            'name'          => 'Eliminar Translados',
            'slug'          => 'CREATE_TRASLADOS',
            'description'   => 'Podria eliminar Translados',
        ]);
        Permission::create([
            'name'          => 'Ver Translados',
            'slug'          => 'READ_TRASLADOS',
            'description'   => 'Lista y navega Translados',
        ]);
        Permission::create([
            'name'          => 'Eliminar Translados',
            'slug'          => 'DELETE_TRASLADOS',
            'description'   => 'Podria eliminar Translados',
        ]);
        Permission::create([
            'name'          => 'Creación Licencias',
            'slug'          => 'CREATE_LICENCIAS',
            'description'   => 'Podria crear Licencias',
        ]);
        Permission::create([
            'name'          => 'Ver Licencias',
            'slug'          => 'READ_LICENCIAS',
            'description'   => 'Lista y navega Licencias',
        ]);
        Permission::create([
            'name'          => 'Eliminar Licencias',
            'slug'          => 'DELETE_LICENCIAS',
            'description'   => 'Podria eliminar Licencias',
        ]);
        Permission::create([
            'name'          => 'Ver Habilidad',
            'slug'          => 'DETAIL_HABILIDAD',
            'description'   => 'Lista y navega Habilidad',
        ]);
        Permission::create([
            'name'          => 'Ver Cuentas',
            'slug'          => 'DETAIL_CUENTAS',
            'description'   => 'Lista y Navega Estado de Cuenta',
        ]);
        Permission::create([
            'name'          => 'Creación Procesos',
            'slug'          => 'CREATE_PROCESO',
            'description'   => 'Podria crear Procesos Disciplinarios',
        ]);
        Permission::create([
            'name'          => 'Ver Procesos',
            'slug'          => 'READ_PROCESO',
            'description'   => 'Lista y navega Procesos Disciplinarios',
        ]);
        Permission::create([
            'name'          => 'Eliminar Procesos',
            'slug'          => 'DELETE_PROCESO',
            'description'   => 'Podria eliminar Procesos Disciplinarios',
        ]);
        Permission::create([
            'name'          => 'Creación Apelaciones',
            'slug'          => 'CREATE_APELACIONES',
            'description'   => 'Podria crear Apelaciones',
        ]);
        Permission::create([
            'name'          => 'Ver Apelaciones',
            'slug'          => 'READ_APELACIONES',
            'description'   => 'Lista y navega Apelaciones',
        ]);
        Permission::create([
            'name'          => 'Eliminar Apelaciones',
            'slug'          => 'DELETE_APELACIONES',
            'description'   => 'Podria Eliminar Apelaciones',
        ]);

        Permission::create([
            'name'          => 'Validar Inscripcion',//Seretaria 46
            'slug'          => 'UPDATE_COLEGIADO_STEP_1',
            'description'   => 'Podria Validar Inscripcion',
        ]);
        Permission::create([
            'name'          => 'Solicitar Colegiatura',//departamental 47
            'slug'          => 'UPDATE_COLEGIADO_STEP_2',//
            'description'   => 'Podria Solicitar Colegiatura',
        ]);
        Permission::create([
            'name'          => 'Resolver Solicitud Colegiatura',//departamental 48
            'slug'          => 'UPDATE_COLEGIADO_STEP_3',
            'description'   => 'Podria Resolver Solicitud Colegiatura',
        ]);
        Permission::create([
            'name'          => 'Validar Solicitud Colegiatura',//Seretaria 49 
            'slug'          => 'UPDATE_COLEGIADO_STEP_4',
            'description'   => 'Podria Validar Solicitud Colegiatura',
        ]);
        Permission::create([
            'name'          => 'Generar Carnet',//departamental 50 
            'slug'          => 'UPDATE_COLEGIADO_STEP_5',
            'description'   => 'Podria Generar Carnet',
        ]);
        Permission::create([
            'name'          => 'Programar Juramentacion',//departamental 51
            'slug'          => 'UPDATE_COLEGIADO_STEP_6',
            'description'   => 'Podria Programar Juramentacion',
        ]);
        Permission::create([
            'name'          => 'Validar Juramentacion',//departamental 52
            'slug'          => 'UPDATE_COLEGIADO_STEP_7',
            'description'   => 'Podria Validar Juramentacion',
        ]);

        Permission::create([
            'name'          => 'Ver Beneficiario',//53
            'slug'          => 'READ_BENEFICIARIO',
            'description'   => 'Lista y navega Beneficiario',
        ]);
        Permission::create([
            'name'          => 'Creación Beneficiario',
            'slug'          => 'CREATE_BENEFICIARIO',
            'description'   => 'Lista Crear Beneficiario',
        ]);
        Permission::create([
            'name'          => 'Eliminar Beneficiario',
            'slug'          => 'DELETE_BENEFICIARIO',
            'description'   => 'Podria eliminar Beneficiario',
        ]);
        //permission_user

        Permission::create([
            'name'          => 'Crear CAJACHICA',
            'slug'          => 'CREATE_CAJACHICA',
            'description'   => 'Podria Crear CAJACHICA',
        ]);
        Permission::create([
            'name'          => 'Ver CAJACHICA',
            'slug'          => 'READ_CAJACHICA',
            'description'   => 'Podria Ver y litar  CAJACHICA',
        ]);
        Permission::create([
            'name'          => 'Ver DEUDAS',
            'slug'          => 'READ_DEUDAS',
            'description'   => 'Podria Ver y litar DEUDAS',
        ]);
        Permission::create([
            'name'          => 'Crear GASTOS',
            'slug'          => 'CREATE_GASTOS',
            'description'   => 'Podria Crear GASTOS',
        ]);
        Permission::create([
            'name'          => 'Ver GASTOS',
            'slug'          => 'READ_GASTOS',
            'description'   => 'Podria Ver y litar  GASTOS',
        ]);
        Permission::create([
            'name'          => 'Ver INGRESOS',
            'slug'          => 'READ_INGRESOS',
            'description'   => 'Podria Ver y litar INGRESOS',
        ]);
        Permission::create([
            'name'          => 'Crear INVENTARIOS',
            'slug'          => 'CREATE_INVENTARIOS',
            'description'   => 'Podria Crear INVENTARIOS',
        ]);
        Permission::create([
            'name'          => 'Ver Beneficiario',
            'slug'          => 'READ_INVENTARIOS',
            'description'   => 'Podria Ver y litar INVENTARIOS',
        ]);
        Permission::create([
            'name'          => 'Crear PRESUPUESTOS',
            'slug'          => 'CREATE_PRESUPUESTOS',
            'description'   => 'Podria Crear PRESUPUESTOS',
        ]);
        Permission::create([
            'name'          => 'Ver PRESUPUESTOS',
            'slug'          => 'READ_PRESUPUESTOS',
            'description'   => 'Podria Ver y litar PRESUPUESTOS',
        ]);
        Permission::create([
            'name'          => 'Crear RENDICIONES',
            'slug'          => 'CREATE_RENDICIONES',
            'description'   => 'Podria Crear RENDICIONES',
        ]);
        Permission::create([
            'name'          => 'Ver RENDICIONES',
            'slug'          => 'READ_RENDICIONES',
            'description'   => 'Podria Ver y litar RENDICIONES',
        ]);
        Permission::create([
            'name'          => 'Crear FRACCIONAMIENTO',
            'slug'          => 'CREATE_FRACCIONAMIENTO',
            'description'   => 'Podria Crear FRACCIONAMIENTO',
        ]);
        Permission::create([
            'name'          => 'Ver FRACCIONAMIENTO',
            'slug'          => 'READ_FRACCIONAMIENTO',
            'description'   => 'Podria Ver y litar FRACCIONAMIENTO',
        ]);

        //opciones que no estan en e front end
        
        Permission::create([
            'name'          => 'Crear INVOICES',
            'slug'          => 'CREATE_INVOICES',
            'description'   => 'Podria Crear INVOICES',
        ]);
        Permission::create([
            'name'          => 'Ver INVOICES',
            'slug'          => 'READ_INVOICES',
            'description'   => 'Podria Ver y litar INVOICES',
        ]);
        Permission::create([
            'name'          => 'Editar INVOICES',
            'slug'          => 'UPDATE_INVOICES',
            'description'   => 'Podria Editar INVOICES',
        ]);
        Permission::create([
            'name'          => 'Ver Detalle INVOICES',
            'slug'          => 'DETAIL_INVOICES',
            'description'   => 'Podria Ver Detalle INVOICES',
        ]);
        Permission::create([
            'name'          => 'Eliminar INVOICES',
            'slug'          => 'DELETE_INVOICES',
            'description'   => 'Podria Eliminar INVOICES',
        ]);

        Permission::create([
            'name'          => 'Crear COMITES',
            'slug'          => 'CREATE_COMITES',
            'description'   => 'Podria Crear COMITES',
        ]);
        Permission::create([
            'name'          => 'Ver COMITES',
            'slug'          => 'READ_COMITES',
            'description'   => 'Podria Ver y litar COMITES',
        ]);
        Permission::create([
            'name'          => 'Editar COMITES',
            'slug'          => 'UPDATE_COMITES',
            'description'   => 'Podria Editar COMITES',
        ]);
        Permission::create([
            'name'          => 'Ver Detalle COMITES',
            'slug'          => 'DETAIL_COMITES',
            'description'   => 'Podria Ver Detalle COMITES',
        ]);
        Permission::create([
            'name'          => 'Eliminar COMITES',
            'slug'          => 'DELETE_COMITES',
            'description'   => 'Podria Eliminar COMITES',
        ]);

        Permission::create([
            'name'          => 'Crear LISTAPOSTULANTES',
            'slug'          => 'CREATE_LISTAPOSTULANTES',
            'description'   => 'Podria Crear LISTAPOSTULANTES',
        ]);
        Permission::create([
            'name'          => 'Ver LISTAPOSTULANTES',
            'slug'          => 'READ_LISTAPOSTULANTES',
            'description'   => 'Podria Ver y listar LISTAPOSTULANTES',
        ]);
        Permission::create([
            'name'          => 'Editar LISTAPOSTULANTES',
            'slug'          => 'UPDATE_LISTAPOSTULANTES',
            'description'   => 'Podria Editar LISTAPOSTULANTES',
        ]);
        Permission::create([
            'name'          => 'Ver Detalle LISTAPOSTULANTES',
            'slug'          => 'DETAIL_LISTAPOSTULANTES',
            'description'   => 'Podria Ver Detalle LISTAPOSTULANTES',
        ]);
        Permission::create([
            'name'          => 'Eliminar LISTAPOSTULANTES',
            'slug'          => 'DELETE_LISTAPOSTULANTES',
            'description'   => 'Podria Eliminar LISTAPOSTULANTES',
        ]);


        Permission::create([
            'name'          => 'Crear LISTAGANADORA',
            'slug'          => 'CREATE_LISTAGANADORA',
            'description'   => 'Podria Crear LISTAGANADORA',
        ]);
        Permission::create([
            'name'          => 'Ver LISTAGANADORA',
            'slug'          => 'READ_LISTAGANADORA',
            'description'   => 'Podria Ver y listar LISTAGANADORA',
        ]);
        Permission::create([
            'name'          => 'Editar LISTAGANADORA',
            'slug'          => 'UPDATE_LISTAGANADORA',
            'description'   => 'Podria Editar LISTAGANADORA',
        ]);
        Permission::create([
            'name'          => 'Ver Detalle LISTAGANADORA',
            'slug'          => 'DETAIL_LISTAGANADORA',
            'description'   => 'Podria Ver Detalle LISTAGANADORA',
        ]);
        Permission::create([
            'name'          => 'Eliminar LISTAGANADORA',
            'slug'          => 'DELETE_LISTAGANADORA',
            'description'   => 'Podria Eliminar LISTAGANADORA',
        ]);

        Permission::create([
            'name'          => 'Crear RESULTADOELECCIONES',
            'slug'          => 'CREATE_RESULTADOELECCIONES',
            'description'   => 'Podria Crear RESULTADOELECCIONES',
        ]);
        Permission::create([
            'name'          => 'Ver RESULTADOELECCIONES',
            'slug'          => 'READ_RESULTADOELECCIONES',
            'description'   => 'Podria Ver y listar RESULTADOELECCIONES',
        ]);
        Permission::create([
            'name'          => 'Editar RESULTADOELECCIONES',
            'slug'          => 'UPDATE_RESULTADOELECCIONES',
            'description'   => 'Podria Editar RESULTADOELECCIONES',
        ]);
        Permission::create([
            'name'          => 'Ver Detalle RESULTADOELECCIONES',
            'slug'          => 'DETAIL_RESULTADOELECCIONES',
            'description'   => 'Podria Ver Detalle RESULTADOELECCIONES',
        ]);
        Permission::create([
            'name'          => 'Eliminar RESULTADOELECCIONES',
            'slug'          => 'DELETE_RESULTADOELECCIONES',
            'description'   => 'Podria Eliminar RESULTADOELECCIONES',
        ]);


        Permission::create([
            'name'          => 'Crear EMPRESA',
            'slug'          => 'CREATE_EMPRESA',
            'description'   => 'Podria Crear EMPRESA',
        ]);
        Permission::create([
            'name'          => 'Ver EMPRESA',
            'slug'          => 'READ_EMPRESA',
            'description'   => 'Podria Ver y listar EMPRESA',
        ]);
        Permission::create([
            'name'          => 'Editar EMPRESA',
            'slug'          => 'UPDATE_EMPRESA',
            'description'   => 'Podria Editar EMPRESA',
        ]);
        Permission::create([
            'name'          => 'Ver Detalle EMPRESA',
            'slug'          => 'DETAIL_EMPRESA',
            'description'   => 'Podria Ver Detalle EMPRESA',
        ]);
        Permission::create([
            'name'          => 'Eliminar EMPRESA',
            'slug'          => 'DELETE_EMPRESA',
            'description'   => 'Podria Eliminar EMPRESA',
        ]);



        Permission::create([
            'name'          => 'Crear CONCEPTOS',
            'slug'          => 'CREATE_CONCEPTOS',
            'description'   => 'Podria Crear CONCEPTOS',
        ]);
        Permission::create([
            'name'          => 'Ver CONCEPTOS',
            'slug'          => 'READ_CONCEPTOS',
            'description'   => 'Podria Ver y listar CONCEPTOS',
        ]);
        Permission::create([
            'name'          => 'Editar CONCEPTOS',
            'slug'          => 'UPDATE_CONCEPTOS',
            'description'   => 'Podria Editar CONCEPTOS',
        ]);
        Permission::create([
            'name'          => 'Ver Detalle CONCEPTOS',
            'slug'          => 'DETAIL_CONCEPTOS',
            'description'   => 'Podria Ver Detalle CONCEPTOS',
        ]);
        Permission::create([
            'name'          => 'Eliminar CONCEPTOS',
            'slug'          => 'DELETE_CONCEPTOS',
            'description'   => 'Podria Eliminar CONCEPTOS',
        ]);

        Permission::create([
            'name'          => 'Enviar BOLETAFACTURA',
            'slug'          => 'SEND_BOLETAFACTURA',
            'description'   => 'Podria Enviar BOLETAFACTURA',
        ]);
        Permission::create([
            'name'          => 'Enviar NOTACREDITO',
            'slug'          => 'SEND_NOTACREDITO',
            'description'   => 'Podria Enviar NOTACREDITO',
        ]);
        Permission::create([
            'name'          => 'Enviar NOTADEBITO',
            'slug'          => 'SEND_NOTADEBITO',
            'description'   => 'Podria Enviar NOTADEBITO',
        ]);



    }
}
