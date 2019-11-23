<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){

    // en el front tienes que crear dos rutas
    //1 ruta para ingresar el email: GET password/reset
    // esta ruta enviara el email a "password/email" y este enviara un email a la persona

    //2 ruta para ingresar el nuevo password password/reset/{token}
    // esta ruta es para digitar dos password iguales y este debe enviar el token a la ruta "password/reset"
    //el servidor redireccionara a la ruta redirecTo del controlador ResetPasswordController
    //si algo fue mal esto redireccionara ala ruta actual pero con errores, esto se debera modificar
    Route::post('password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Api\ResetPasswordController@reset');

    Route::post('login', 'Api\AuthController@login');

    Route::post('register', 'Api\AuthController@register');

    Route::get('peruconsult/dni/{dni}', 'PeruConsultController@dni');
    Route::get('peruconsult/ruc/{ruc}', 'PeruConsultController@ruc');
    Route::get('peruconsult/sol/{ruc}/{u}', 'PeruConsultController@sol');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('getUser', 'Api\AuthController@getUser');
        Route::post('logout', 'Api\AuthController@logout');
        //apis
        Route::apiResource('permissions','Api\PermissionController');
        Route::apiResource('roles','Api\RoleController');
        Route::apiResource('users','Api\UserController');
        Route::apiResource('diplomas','Api\EntregaDiplomaController');
        Route::apiResource('incidentes','Api\IncidenteController');
        Route::apiResource('translados','Api\TransladoController');
        Route::apiResource('licencias','Api\LicenciaController');
        Route::apiResource('procesos','Api\ProcesoDisciplinarioController');
        Route::apiResource('apelaciones','Api\ApelacionController');
        Route::apiResource('comites','Api\ComiteController');
        Route::apiResource('listasGanadoras','Api\ListaGanadoraController');
        Route::apiResource('listaPostulantes','Api\ListaPostulanteController');
        Route::apiResource('resultadoElecciones','Api\ResultadoEleccionController');
        Route::apiResource('personas','Api\PersonaController');

        Route::get('colegiados','Api\ColegiadoController@index');
        Route::get('personasPagos','Api\ColegiadoController@personasPagos');

        //Tipos
        Route::apiResource('tipoIncidentes','Api\Tipos\TipoIncidenteController');
        Route::apiResource('sanciones','Api\Tipos\SancionController');

        Route::apiResource('especialidadPosgrado','Api\Tipos\EspecialidadPosgradoController');
        Route::apiResource('areaEjercicioProfesional','Api\Tipos\AreaEjercicioProfesionalController');
        Route::apiResource('universidades','Api\Tipos\UniversidadController');
        Route::apiResource('cargoPostulantes','Api\Tipos\CargoPostulanteController');

        Route::apiResource('tipoProcesoDisciplinario','Api\Tipos\TipoProcesoDisciplinarioController');
        Route::apiResource('tipoDocumentoIdentidad','Api\Tipos\TipoDocumentoIdentidadController');
        Route::apiResource('estadoCivil','Api\Tipos\EstadoCivilController');
        Route::apiResource('tipoDocumentoPago','Api\Tipos\TipoDocumentoPagoController');
        Route::apiResource('estadoCuentaSistema','Api\Tipos\EstadoCuentaSistemaController');
        Route::apiResource('estadoRegistroColegiado','Api\Tipos\EstadoRegistroColegiadoController');
        Route::apiResource('tipoGasto','Api\Tipos\TipoGastoController');

        Route::apiResource('ubigeos','Api\Tipos\UbigeoController');

        Route::get('listasParaRendiciones','Api\Tipos\ListaController@rendiciones');
        Route::get('listasParaInventarios','Api\Tipos\ListaController@inventarios');
        Route::get('listasParaPresupuestos','Api\Tipos\ListaController@presupuestos');
        Route::get('listasParaCajachica','Api\Tipos\ListaController@cajachica');
        Route::get('listasParaInvoices','Api\Tipos\ListaController@invoices');
        Route::get('listasParaGastos','Api\Tipos\ListaController@gastos');
        Route::get('listasParaListasInvoices','Api\Tipos\ListaController@listasInvoices');

        Route::apiResource('beneficiarios', 'Api\BeneficiarioController');
        Route::apiResource('rendiciones', 'Api\RendicionController');
        //FFEE
        Route::apiResource('clientes','Api\FFEE\ClienteController');
        Route::apiResource('empresas','Api\FFEE\EmpresaController');
        Route::apiResource('invoices','Api\FFEE\InvoiceController');
        Route::apiResource('series','Api\FFEE\SerieController');

        Route::apiResource('tipoOperacion','Api\FFEE\TipoOperacionController');
        Route::get('conceptoPago','Api\FFEE\ConceptoController@conceptoPago');//Deprecated
        Route::apiResource('concepto','Api\FFEE\ConceptoController');
        Route::apiResource('invoiceDetail','Api\FFEE\InvoiceDetailController');
        Route::apiResource('gastos','Api\Contabilidad\GastoController');
        Route::apiResource('responsables','Api\Contabilidad\ResponsableController');
        Route::apiResource('inventarios','Api\Contabilidad\InventarioController');
        Route::apiResource('presupuestos','Api\Contabilidad\PresupuestoController');
        Route::apiResource('cajaChica','Api\Contabilidad\CajaChicaController');

        Route::post('sunat/envio/{invoiceId}','Api\FFEE\InvoiceSunatController@boletaFactura');
        Route::post('sunat/notacredito','Api\FFEE\InvoiceSunatController@notaCredito');
        Route::post('sunat/notadebito','Api\FFEE\InvoiceSunatController@notaDebito');

        Route::post('procesoColegiado/inscripcion','Api\ProcesoColegiadoController@inscripcion');
        Route::post('procesoColegiado/solicitarColegiatura','Api\ProcesoColegiadoController@solicitarColegiatura');
        Route::post('procesoColegiado/completarSolicitud','Api\ProcesoColegiadoController@completarSolicitud');
        Route::post('procesoColegiado/validarSolicitud','Api\ProcesoColegiadoController@validarSolicitud');
        Route::post('procesoColegiado/programarJuramentacion','Api\ProcesoColegiadoController@programarJuramentacion');
        Route::post('procesoColegiado/validarJuramentacion','Api\ProcesoColegiadoController@validarJuramentacion');
        Route::post('procesoColegiado/generarCarnet','Api\ProcesoColegiadoController@generarCarnet');
        Route::post('procesoColegiado/solicitudFAF','Api\ProcesoColegiadoController@solicitudFAF');


        Route::apiResource('pagos','Api\PagoController');

        Route::get('sunat/files/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files_sunat/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('cvs/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/cvs/'.$path);
            return response()->file($pathToFile);
        });

        // http://exposicion.juan/api/v1/documentos/procesosDisciplinarios/1574272552.pdf
        Route::get('documentos/procesosDisciplinarios/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/documentos/procesosDisciplinarios/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('documentos/apelaciones/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/documentos/apelaciones/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('documentos/incidentes/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/documentos/incidentes/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('documentos/translados/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/documentos/translados/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('documentos/licencias/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/documentos/licencias/'.$path);
            return response()->file($pathToFile);
        });

    });

    
});