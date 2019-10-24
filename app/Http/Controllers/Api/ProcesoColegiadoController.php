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
use App\Repositories\Interfaces\PersonaRepositoryInterface;

class ProcesoColegiadoController extends Controller
{
    private $personaRepository;

    public function __construct( PersonaRepositoryInterface $personaRepository )
    {
        $this->personaRepository = $personaRepository;
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

    protected function validateProgramarJuramentacion(Request $request){
        $this->validate($request,[
            'fecha_juramentacion'           => 'required|date_format:Y-m-d',
            'persona_id'                    => 'required|exists:personas,id',
        ]);
    }

    protected function validateValidarJuramentacion(Request $request){
        $this->validate($request,[
            'persona_id'                    => 'required|exists:personas,id',
        ]);
    }

    protected function validateSolicitudFAF(Request $request){
        $this->validate($request,[
            'fecha_solicitud_faf'           => 'required|date_format:Y-m-d',
            'fecha_recepcion_faf'           => 'required|date_format:Y-m-d',
            'fecha_firma_consejo'           => 'required|date_format:Y-m-d',
            'persona_id'                    => 'required|exists:personas,id',
        ]);
    }
    //1
    public function inscripcion(Request $request)
    {
        $this->validateInscripcion($request);

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::INSCRITO ]);
        $request->merge(['is_inscripcion' => 1 ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    //2
    public function solicitarColegiatura(Request $request)
    {
        $this->validateSolicitarColegiatura($request);

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::SOLICITUD_PENDIENTE ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    //3
    public function completarSolicitud(Request $request)
    {
        $this->validateCompletarSolicitud($request);

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::SOLICITUD_RESUELTA ]);
        $request->merge(['is_resuelve_consejo' => 1 ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    //4
    public function validarSolicitud(Request $request)
    {
        $this->validateValidarSolicitud($request);

        $numero_cmvp = $this->personaRepository->getMaxNumeroCmvp()+1;

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::SOLICITUD_VALIDADA ]);
        $request->merge(['is_solicitud' => 1 ]);
        $request->merge(['fecha_colegiatura' => $request->fecha_llegada_solicitud ]);
        $request->merge(['numero_cmvp' => $numero_cmvp]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    //5
    public function generarCarnet(Request $request)
    {
        $this->validateGenerarCarnet($request);

        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::CARNET_GENERADO ]);
        $request->merge(['is_carnet' => 1 ]);
        $request->merge(['fecha_aprobacion_consejo' => $request->fecha_registro_carnet ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    //6
    public function programarJuramentacion(Request $request)
    {
        $this->validateProgramarJuramentacion($request);
        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::JURAMENTACION_PROGRAMADA ]);
        $request->merge(['is_juramentacion_programada' => 1 ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }
    //7
    public function validarJuramentacion(Request $request)
    {
        $this->validateValidarJuramentacion($request);
        $persona = Persona::find($request->persona_id);
        $request->merge(['estado_registro_colegiado_id' => EstadoRegistroColegiado::JURAMENTACION_VALIDADA ]);
        $request->merge(['is_juramentacion_validada' => 1 ]);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }

    public function solicitudFAF(Request $request)
    {
        $this->validateSolicitudFAF($request);

        $persona = Persona::find($request->persona_id);
        $persona->update( $request->all() );
        return new PersonaResource($persona);
    }

}
