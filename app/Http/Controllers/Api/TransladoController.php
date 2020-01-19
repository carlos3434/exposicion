<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Translado;
use Illuminate\Http\Request;
use App\Http\Requests\Translado as TransladoRequest;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;
use App\Persona;
use App\Http\Resources\Translado\TransladoCollection;
use App\Http\Resources\Translado\TransladoExcelCollection;
use App\Http\Resources\Translado\Translado as TransladoResource;
use App\Helpers\FileUploader;

class TransladoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_TRASLADOS')->only(['create','store']);
        $this->middleware('can:READ_TRASLADOS')->only('index');
        $this->middleware('can:UPDATE_TRASLADOS')->only(['edit','update']);
        $this->middleware('can:DETAIL_TRASLADOS')->only('show');
        $this->middleware('can:DELETE_TRASLADOS')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Translado::filter($request)->with([
            'origenDepartamento',
            'destinoDepartamento',
            'persona'
        ]);

        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new TransladoExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'translados_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new TransladoCollection($query->sort()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransladoRequest $request, FileUploader $fileUploader)
    {
        $all = $request->all();
        if ( $request->has('url_documento') ) {
            $all['url_documento'] = $fileUploader->upload( $request->file('url_documento'), 'documentos/translados');
        }
        $persona = Persona::find($request->persona_id);

        $mensajeError = '';
        if ($persona->is_habilitado==0) {
            $mensajeError = 'Colegiado no se encuentra Habilitado';
        }
        if ($persona->total_deuda > 0) {
            $mensajeError = 'Colegiado tiene deuda pendiente de: S/.'.$persona->total_deuda;
        }
        if ($persona->multa_pendiente > 0) {
            $mensajeError = 'Colegiado tiene multa pendiente de: S/.'.$persona->multa_pendiente;
        }
        if ($mensajeError <> '') {
             return response()->json([
                'message' => $mensajeError,
                'errors'  => 'The given data was invalid.',
            ], 422 );
        }
        $translado = Translado::create( $all );
        if ($translado) {
            
            $data = ['departamento_colegiado_id' => $request->destino_departamento_id];
            $persona->update( $data );
        }
        return response()->json($translado, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Translado  $translado
     * @return \Illuminate\Http\Response
     */
    public function show(Translado $translado)
    {
        return new TransladoResource($translado);
        //return $translado;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Translado  $translado
     * @return \Illuminate\Http\Response
     */
    public function update(TransladoRequest $request, Translado $translado, FileUploader $fileUploader)
    {
        $all = $request->all();
        if ( $request->has('url_documento') ) {
            $all['url_documento'] = $fileUploader->upload( $request->file('url_documento'), 'documentos/translados');
        }
        $translado->update( $all );
        return response()->json($translado, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Translado  $translado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Translado $translado)
    {
        $translado->delete();
        return response()->json(null, 204);
    }
}
