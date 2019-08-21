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

Route::get('test', function () {

    /*
    dd("fin");
    $json = file_get_contents( 'http://exposicion.juan/test.json'  );
    $query = json_decode($json);

    dd( !$query->api_key );
    $query->api_key = !isset($query->api_key) ? $this->config['api_key'] : $query->api_key;
    */
    return view('welcome');
});
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
    
});



