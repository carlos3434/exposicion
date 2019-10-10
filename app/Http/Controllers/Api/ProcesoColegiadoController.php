<?php
namespace App\Http\Controllers\Api;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Persona as PersonaRequest;


use App\Http\Resources\Persona\Persona as PersonaResource;
use App\Http\Resources\Persona\PersonaCollection;
use App\Http\Resources\Persona\PersonaExcelCollection;

class ProcesoColegiadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_REGISTRO')->only(['create','store']);
        $this->middleware('can:READ_REGISTRO')->only('index');
        $this->middleware('can:UPDATE_REGISTRO')->only(['edit','update']);
        $this->middleware('can:DETAIL_REGISTRO')->only('show');
        $this->middleware('can:DELETE_REGISTRO')->only('destroy');
    }

    public function inscripcion(Request $request)
    {
        $persona = Persona::find($request->id);
        $persona->update( $request->all() );
        return response()->json($persona, 200);
    }
    public function solicitarColegiatura(Request $request)
    {
        $persona = Persona::find($request->id);
        $persona->update( $request->all() );
        return response()->json($persona, 200);
    }
    public function completarSolicitud(Request $request)
    {
        $persona = Persona::find($request->id);
        $persona->update( $request->all() );
        return response()->json($persona, 200);
    }
    public function validarSolicitud(Request $request)
    {
        $persona = Persona::find($request->id);
        $persona->update( $request->all() );
        return response()->json($persona, 200);
    }
    public function generarCarnet(Request $request)
    {
        $persona = Persona::find($request->id);
        $persona->update( $request->all() );
        return response()->json($persona, 200);
    }

}
