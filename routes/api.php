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
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('getUser', 'Api\AuthController@getUser');
        Route::post('logout', 'Api\AuthController@logout');
        Route::apiResource('permissions','Api\PermissionController');
        Route::apiResource('roles','Api\RoleController');
        Route::apiResource('users','Api\UserController');
        Route::apiResource('diplomas','Api\EntregaDiplomaController');

        Route::apiResource('incidentes','Api\IncidenteController');
        Route::apiResource('translados','Api\TransladoController');
        Route::apiResource('licencias','Api\LicenciaController');

        Route::apiResource('sanciones','Api\SancionController');
        Route::apiResource('procesos','Api\ProcesoDisciplinarioController');
        Route::apiResource('apelaciones','Api\ApelacionController');
        Route::apiResource('comites','Api\ComiteController');
        Route::apiResource('listasGanadoras','Api\ListaGanadoraController');
        Route::apiResource('listaPostulantes','Api\ListaPostulanteController');
        Route::apiResource('resultadoElecciones','Api\ResultadoEleccionController');

        Route::apiResource('registros','Api\RegistroController');

        //Tipos
        Route::apiResource('tipoIncidentes','Api\Tipos\TipoIncidenteController');


        Route::apiResource('especialidadPosgrado','Api\Tipos\EspecialidadPosgradoController');
        Route::apiResource('areaEjercicioProfesional','Api\Tipos\AreaEjercicioProfesionalController');
        Route::apiResource('universidades','Api\Tipos\UniversidadController');
        Route::apiResource('cargoPostulantes','Api\Tipos\CargoPostulanteController');

        Route::apiResource('tipoProcesoDisciplinarios','Api\Tipos\TipoProcesoDisciplinarioController');
        Route::apiResource('tipoDocumentoIdentidad','Api\Tipos\TipoDocumentoIdentidadController');
        Route::apiResource('estadoCivil','Api\Tipos\EstadoCivilController');
        Route::apiResource('tipoDocumentoPago','Api\Tipos\TipoDocumentoPagoController');
        Route::apiResource('estadoCuentaSistema','Api\Tipos\EstadoCuentaSistemaController');
        Route::apiResource('estadoRegistroColegiado','Api\Tipos\EstadoRegistroColegiadoController');

        Route::apiResource('ubigeos','Api\Tipos\UbigeoController');

    });

    
});