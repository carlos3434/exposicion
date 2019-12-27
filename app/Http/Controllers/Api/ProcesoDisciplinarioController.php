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
        $this->middleware('can:CREATE_PROCESO')->only(['create','store']);
        $this->middleware('can:READ_PROCESO')->only('index');
        $this->middleware('can:UPDATE_PROCESO')->only(['edit','update']);
        $this->middleware('can:DETAIL_PROCESO')->only('show');
        $this->middleware('can:DELETE_PROCESO')->only('destroy');
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
                'apelaciones',
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

            $persona = Persona::find($request->persona_id);
            $persona->personaInhabilitada()->create([
                'fecha_inicio'  => $today,
                'fecha_fin'     => '3099-01-01',
            ]);
            $persona->is_habilitado = false;
            $persona->save();
        }
        if ( $request->sancion_id == Sancion::SUSPENCION ) {
            $persona = Persona::find($request->persona_id);
            $persona->personaInhabilitada()->create([
                'fecha_inicio'  => $request->fecha_inicio,
                'fecha_fin'     => $request->fecha_fin,
            ]);
            $persona->is_habilitado = false;
            $persona->save();
        }

        $procesoDisciplinario = ProcesoDisciplinario::create($all);

        if ( $request->sancion_id == Sancion::MULTA ) {

            $concepto = Concepto::find(Concepto::MULTA);
            $fechaVencimiento = date('Y-m-d', strtotime($today. '+ '.$concepto->plazo_dias.'days'));
            $fechaVencimiento = date('Y-m-d', strtotime($fechaVencimiento. '+ '.$concepto->plazo_meses.'months'));

            $persona = Persona::find($request->persona_id);
            $persona->pagos()->create([
                'departamento_id' => $persona->departamento_id,
                'monto' => $request->monto_multa,
                'fecha_vencimiento' => $fechaVencimiento,
                'estado_pago_id' => EstadoPago::PENDIENTE,
                'concepto_id' => $concepto->id,
                'name' => ''.$request->descripcion .' - F. V.' .$fechaVencimiento,
                'proceso_id' => $procesoDisciplinario->id,
            ]);

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
