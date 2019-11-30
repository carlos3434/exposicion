<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Persona;
use App\Apelacion;
use App\Sancion;
use App\Pago;
use App\EstadoPago;
use App\PersonaInhabilitada;
use Illuminate\Http\Request;
use App\Http\Requests\Apelacion as ApelacionRequest;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\Apelacion\ApelacionCollection;
use App\Http\Resources\Apelacion\ApelacionExcelCollection;
use App\Http\Resources\Apelacion\Apelacion as ApelacionResource;
use App\Helpers\FileUploader;

class ApelacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_TRANSLADO')->only(['create','store']);
        $this->middleware('can:READ_TRANSLADO')->only('index');
        $this->middleware('can:UPDATE_TRANSLADO')->only(['edit','update']);
        $this->middleware('can:DETAIL_TRANSLADO')->only('show');
        $this->middleware('can:DELETE_TRANSLADO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Apelacion::filter($request)
            ->with([
                'persona',
                'documento'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ApelacionExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'apelaciones_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ApelacionCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApelacionRequest $request, FileUploader $fileUploader)
    {
        $all = $request->all();
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d' , strtotime($today.'- 1days') );
        if ( $request->has('url_documento') ) {
            $all['url_documento'] = $fileUploader->upload( $request->file('url_documento'), 'documentos/apelaciones');
        }
        $apelacion = Apelacion::create($all);
        //update: proceso_disciplinarios con documento_id
        $apelacion->documento->is_apelacion = 1;
        $apelacion->push();
        if ($apelacion->documento->sancion_id == Sancion::EXPULSION ) {
            $perInhabil = PersonaInhabilitada::where('fecha_fin', '3099-01-01')
            ->where('fecha_inicio', $apelacion->documento->fecha_inicio)
            ->where('persona_id', $apelacion->documento->persona_id )
            ->orderBy('id', 'desc')->first();

            $perInhabil->fecha_fin = $yesterday;
            $perInhabil->save();

            $persona = Persona::find( $apelacion->documento->persona_id );
            $persona->is_habilitado = true;
            $persona->save();
        }
        //buscar si persona tiene sancion de suspencion relacionada 
        if ($apelacion->documento->sancion_id == Sancion::SUSPENCION ) {
            //actualizar PersonaInhabilitada, el campo fecha_fin con today
            $perInhabil = PersonaInhabilitada::where('fecha_inicio', $apelacion->documento->fecha_inicio)
            ->where('fecha_fin', $apelacion->documento->fecha_fin)
            ->where('persona_id', $apelacion->documento->persona_id )
            ->orderBy('id', 'desc')->first();
            

            $perInhabil->fecha_fin = $yesterday;
            $perInhabil->save();
            //habilitar persona
            $persona = Persona::find( $apelacion->documento->persona_id );
            $persona->is_habilitado = true;
            $persona->save();
        }
        if ( $apelacion->documento->sancion_id == Sancion::MULTA ) {
            //buscar pago relacionado al proceso disciplinario
            $pago = Pago::where('proceso_id', $request->documento_id)->first();
            $pago->estado_pago_id = EstadoPago::ELIMINADO;
            $pago->save();

            $persona = Persona::find( $apelacion->documento->persona_id );
            $persona->multa_pendiente -= $apelacion->documento->monto_multa;
            $persona->save();
        }
        return response()->json($apelacion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apelacion  $apelacion
     * @return \Illuminate\Http\Response
     */
    public function show(Apelacion $apelacion)
    {
        return new ApelacionResource($apelacion);
        //return $apelacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apelacion  $apelacion
     * @return \Illuminate\Http\Response
     */
    public function update(ApelacionRequest $request, Apelacion $apelacion, FileUploader $fileUploader)
    {
        $all = $request->all();
        if ( $request->has('url_documento') ) {
            $all['url_documento'] = $fileUploader->upload( $request->file('url_documento'), 'documentos/apelaciones');
        }
        $apelacion->update( $all );
        return response()->json($apelacion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apelacion  $apelacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apelacion $apelacion)
    {
        $apelacion->delete();
        return response()->json(null, 204);
    }
}
