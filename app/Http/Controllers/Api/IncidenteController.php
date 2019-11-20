<?php

namespace App\Http\Controllers\Api;

use App\Incidente;
use Illuminate\Http\Request;
use App\Http\Requests\Incidente as IncidenteRequest;
use App\Http\Controllers\Controller;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\Incidente\IncidenteCollection;
use App\Http\Resources\Incidente\IncidenteExcelCollection;
use App\Http\Resources\Incidente\Incidente as IncidenteResource;
use App\Helpers\FileUploader;

class IncidenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_INCIDENTE')->only(['create','store']);
        $this->middleware('can:READ_INCIDENTE')->only('index');
        $this->middleware('can:UPDATE_INCIDENTE')->only(['edit','update']);
        $this->middleware('can:DETAIL_INCIDENTE')->only('show');
        $this->middleware('can:DELETE_INCIDENTE')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Incidente::filter($request)
            ->with([
                'persona',
                'tipoIncidente'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new IncidenteExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'incidentes_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new IncidenteCollection($query->sort()->paginate() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncidenteRequest $request, FileUploader $fileUploader)
    {
        $all = $request->all();
        if ( $request->has('url_documento') ) {
            $all['url_documento'] = $fileUploader->upload( $request->file('url_documento'), 'documentos/incidentes');
        }
        $incidente = Incidente::create( $all );
        $incidente->persona->save(['numero_incidencias'=>$incidente->persona->numero_incidencias++]);
        return response()->json($incidente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Incidente  $incidente
     * @return \Illuminate\Http\Response
     */
    public function show(Incidente $incidente)
    {
        return new IncidenteResource($incidente);
        //return $incidente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Incidente  $incidente
     * @return \Illuminate\Http\Response
     */
    public function update(IncidenteRequest $request, Incidente $incidente, FileUploader $fileUploader)
    {
        $all = $request->all();
        if ( $request->has('url_documento') ) {
            $all['url_documento'] = $fileUploader->upload( $request->file('url_documento'), 'documentos/incidentes');
        }
        $incidente->update( $all );
        return response()->json($incidente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Incidente  $incidente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidente $incidente)
    {
        $incidente->delete();
        return response()->json(null, 204);
    }
}
