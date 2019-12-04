<?php

namespace App\Http\Controllers\Api;

use App\ProcesoDisciplinario;
use App\Sancion;
use App\Persona;
use App\Concepto;
use App\Pago;
use App\EstadoPago;
use App\PersonaInhabilitada;
use Illuminate\Http\Request;
use App\Http\Requests\ProcesoDisciplinario as ProcesoDisciplinarioRequest;
use App\Http\Controllers\Controller;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\ProcesoDisciplinario\ProcesoDisciplinarioCollection;
use App\Http\Resources\ProcesoDisciplinario\ProcesoDisciplinarioExcelCollection;
use App\Http\Resources\ProcesoDisciplinario\ProcesoDisciplinario as ProcesoDisciplinarioResource;
use App\Helpers\FileUploader;

class ProcesoDisciplinarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_PROCESODISCIPLINARIO')->only(['create','store']);
        $this->middleware('can:READ_PROCESODISCIPLINARIO')->only('index');
        $this->middleware('can:UPDATE_PROCESODISCIPLINARIO')->only(['edit','update']);
        $this->middleware('can:DETAIL_PROCESODISCIPLINARIO')->only('show');
        $this->middleware('can:DELETE_PROCESODISCIPLINARIO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ProcesoDisciplinario::filter($request)
            ->with([
                'persona',
                'sancion',
                'tipoProcesoDisciplinario',
        ]);

        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ProcesoDisciplinarioExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'procesos_disciplinarios_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ProcesoDisciplinarioCollection($query->sort()->paginate());
        //return $query->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcesoDisciplinarioRequest $request, FileUploader $fileUploader)
    {
        $all = $request->all();
        $today = date("Y-m-d");
        if ( $request->has('url_documento') ) {
            $all['url_documento'] = $fileUploader->upload( $request->file('url_documento'), 'documentos/procesosDisciplinarios');
        }
        if ( $request->sancion_id == Sancion::EXPULSION ) {
            PersonaInhabilitada::create([
                'persona_id'    => $request->persona_id,
                'fecha_inicio'  => $today,
                'fecha_fin'     => '3099-01-01',
            ]);
            $persona = Persona::find($request->persona_id);
            $persona->is_habilitado = false;
            $persona->save();
            //crear proceso automatico que habilite a una persona despues de la fecha fin de suspencion
        }
        if ( $request->sancion_id == Sancion::SUSPENCION ) {
            PersonaInhabilitada::create([
                'persona_id'    => $request->persona_id,
                'fecha_inicio'  => $request->fecha_inicio,
                'fecha_fin'     => $request->fecha_fin,
            ]);
            $persona = Persona::find($request->persona_id);
            $persona->is_habilitado = false;
            $persona->save();
            //crear proceso automatico que habilite a una persona despues de la fecha fin de suspencion
        }

        $procesoDisciplinario = ProcesoDisciplinario::create($all);

        if ( $request->sancion_id == Sancion::MULTA ) {

            $concepto = Concepto::find(Concepto::MULTA);
            $fechaVencimiento = date('Y-m-d', strtotime($today. '+ '.$concepto->plazo_dias.'days'));
            $fechaVencimiento = date('Y-m-d', strtotime($fechaVencimiento. '+ '.$concepto->plazo_meses.'months'));

            Pago::create([
                'monto' => $request->monto_multa,
                'fecha_vencimiento' => $fechaVencimiento,
                'estado_pago_id' => EstadoPago::PENDIENTE,
                'concepto_id' => $concepto->id,
                'persona_id' => $request->persona_id,
                'name' => ''.$request->descripcion .' - F. V.' .$fechaVencimiento,
                'proceso_id' => $procesoDisciplinario->id,
            ]);
            $persona = Persona::find($request->persona_id);
            $persona->multa_pendiente += $request->monto_multa;
            $persona->save();
        }

        $procesoDisciplinario->persona->save(['numero_procesos_disciplinarios'=>$procesoDisciplinario->persona->numero_procesos_disciplinarios++]);
        return response()->json($procesoDisciplinario, 201);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return \Illuminate\Http\Response
     */
    public function show(ProcesoDisciplinario $procesoDisciplinario)
    {
        return new ProcesoDisciplinarioResource($procesoDisciplinario);
        //return $procesoDisciplinario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return \Illuminate\Http\Response
     */
    public function update(ProcesoDisciplinarioRequest $request, ProcesoDisciplinario $procesoDisciplinario, FileUploader $fileUploader)
    {
        $all = $request->all();
        if ( $request->has('url_documento') ) {
            $all['url_documento'] = $fileUploader->upload( $request->file('url_documento'), 'documentos/procesosDisciplinarios');
        }
        $procesoDisciplinario->update( $all );

        return response()->json($procesoDisciplinario, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProcesoDisciplinario  $procesoDisciplinario
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcesoDisciplinario $procesoDisciplinario)
    {
        $procesoDisciplinario->delete();
        return response()->json(null, 204);
    }
}
