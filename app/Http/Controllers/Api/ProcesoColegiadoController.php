<?php
namespace App\Http\Controllers\Api;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Persona as PersonaRequest;


use App\Http\Resources\Persona\Persona as PersonaResource;
use App\Http\Resources\Persona\PersonaCollection;
use App\Http\Resources\Persona\PersonaExcelCollection;
use App\EstadoRegistroColegiado;

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
    protected function validateInscripcion(Request $request){
        $this->validate($request,[
            'fecha_inscripcion'             => 'required|date_format:Y-m-d',
            'persona_id'                    => 'required|exists:personas,id',
        ]);
    }
    protected function validateSolicitarColegiatura(Request $request){
        $this->validate($request,[
            'fecha_presentacion_solicitud'  => 'required|date_format:Y-m-d',
            'fecha_sesion'                  => 'required|date_format:Y-m-d',
            'persona_id'                    => 'required|exists:personas,id',
        ]);
    }
    protected function validateCompletarSolicitud(Request $request){
        $this->validate($request,[
            'fecha_resuelve_consejo'        => 'required|date_format:Y-m-d',
            'estado_solicitud'              => 'required|in:Aprobado,Denegado', ////Aprovado / Denegado
            'persona_id'                    => 'required|exists:personas,id',
        ]);
    }
    protected function validateValidarSolicitud(Request $request){
        $this->validate($request,[
            'fecha_llegada_solicitud'       => 'required|date_format:Y-m-d',
            'persona_id'                    => 'required|exists:personas,id',
        ]);
    }
    protected function validateGenerarCarnet(Request $request){
        $this->validate($request,[
            'fecha_registro_carnet'         => 'required|date_format:Y-m-d',
            'fecha_emision_carnet'          => 'required|date_format:Y-m-d',
            'fecha_caducidad_carnet'        => 'required|date_format:Y-m-d',
            'persona_id'                    => 'required|exists:personas,id',
        ]);
    }
    public function inscripcion(Request $request)
    {
        $this->validateInscripcion($request);

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::INSCRITO ]);
        $request->merge(['is_inscripcion' => 1 ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    public function solicitarColegiatura(Request $request)
    {
        $this->validateSolicitarColegiatura($request);

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::SOLICITUD_PENDIENTE ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    public function completarSolicitud(Request $request)
    {
        $this->validateCompletarSolicitud($request);

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::SOLICITUD_RESUELTA ]);
        $request->merge(['is_resuelve_consejo' => 1 ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    public function validarSolicitud(Request $request)
    {
        $this->validateValidarSolicitud($request);

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::SOLICITUD_VALIDADA ]);
        $request->merge(['is_solicitud' => 1 ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    public function generarCarnet(Request $request)
    {
        $this->validateGenerarCarnet($request);

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::CARNET_GENERADO ]);
        $request->merge(['is_carnet' => 1 ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }

}
