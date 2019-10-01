<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('greenter/test','GreenterExampleController@test');
Route::get('greenter/envio','GreenterExampleController@envio');
Route::get('greenter/factura/{numero}','GreenterExampleController@factura');
Route::get('greenter/boleta','GreenterExampleController@boleta');
Route::get('greenter/nota','GreenterExampleController@nota');
Route::get('greenter/resumen','GreenterExampleController@resumen');

Route::get('/peruconsult/dni/{dni}', 'PeruConsultController@dni');
Route::get('/peruconsult/ruc/{ruc}', 'PeruConsultController@ruc');
Route::get('/peruconsult/sol/{ruc}/{u}', 'PeruConsultController@sol');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('shares', 'ShareController');

Route::get('email', function() {
    Mail::send('auth.verify', [], function ($message) {
        $message->to('carlos34343434@gmail.com', 'HisName')
                ->subject('Welcome!');
    });
});
//Route::get('users/export/', 'UserController@export');

//Auth::routes();

Auth::routes(['verify' => true]);

Route::get('files_sunat/{path}', function ($path) {
    $pathToFile = storage_path('app/uploads/files_sunat/'.$path);
    return response()->file($pathToFile);
});
Route::get('logos/{path}', function ($path) {
    $pathToFile = storage_path('app/uploads/logos/'.$path);
    return response()->file($pathToFile);
});
Route::get('photos/{path}', function ($path) {
    $pathToFile = storage_path('app/uploads/photos/'.$path);
    return response()->file($pathToFile);
});

Route::get('/home', 'HomeController@index')->name('home');


//ruta test
Route::get('/juan', 'PermissionController@index');
Route::get('/juan/{permission}', 'PermissionController@update');


//routes
Route::middleware(['auth' => true ])->group(function(){
    //permisos
    Route::resource('permissions','PermissionController');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('empresas','EmpresaController');
    
});



