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

//Route::get('personas','Api\PersonaController@index');
use Illuminate\Http\Request;
use App\Persona;
use App\Http\Resources\Persona\PersonaCollection;
use App\Http\Resources\Persona\Persona as PersonaResource;

use App\Translado;
use App\Http\Resources\Translado\TransladoCollection;
use App\Http\Resources\Translado\Translado as TransladoResource;

use App\User;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\User as UserResource;

use GuzzleHttp\Client;
use Peru\Http\ContextClient;
use Peru\Jne\{Dni, DniParser};
use Peru\Sunat\{HtmlParser, Ruc, RucParser};
use Peru\Sunat\UserValidator;

Route::get('/peruconsult/dni/{dni}', 'PeruConsultController@dni');
Route::get('/peruconsult/ruc/{ruc}', 'PeruConsultController@ruc');
Route::get('/peruconsult/sol/{ruc}/{u}', 'PeruConsultController@sol');

Route::get('usuarios', function (Request $request) {
    return new UserCollection(
            User::filter($request)
                ->sort()->paginate()
                //->orderBy($sortBy,$direction)
                //->paginate($per_page)
        );
});
Route::get('dni/{dni}', function($dni) {
    $cs = new Dni(new ContextClient(), new DniParser());
    $person = $cs->get($dni);
    if (!$person) {
        echo 'Not found';
        exit();
    }
    echo json_encode($person);
});

Route::get('ruc/{ruc}', function($ruc) {
    $cs = new Ruc(new ContextClient(), new RucParser(new HtmlParser()));
    $company = $cs->get($ruc);
    if (!$company) {
        echo 'Not found';
        exit();
    }
    echo json_encode($company);
});

Route::get('sol/{ruc}/{u}', function($ruc, $u) {
    //$ruc = '10455316567'; // colocar un ruc válido
    //$u = 'MILECTIO'; // colocar un usuario según el ruc

    $cs = new UserValidator(new ContextClient());
    $valid = $cs->valid($ruc, $u);
    if ($valid) {
        echo 'Válido';
    } else {
        echo 'Inválido';
    }
});



Route::get('persona', function () {
    //return new PersonaResource (Persona::find(1));

    return new PersonaCollection(
            Persona::with([
                'tipoDocumentoIdentidad',
                'nacionalidad',
                'estadoCivil',
                'ubigeo',
                'universidadProcedencia',
                'especialidadPosgrado',
                'areaEjercicioProfesional',
                'departamentoColegiado',
                'estadoRegistroColegiado',
                'estadoCuentaSistema'
            ])->orderBy('id','asc')
            ->paginate(25)
    );
});
Route::get('translado', function (Request $request) {
    //return new PersonaResource (Persona::find(1));

    return new TransladoCollection(
            Translado::filter($request)->with([
                'origenDepartamento',
                'destinoDepartamento',
                'persona'
            ])->orderBy('id','asc')
            ->paginate(25)
    );
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



