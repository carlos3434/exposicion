<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ListaGanadora;
use Illuminate\Http\Request;
use App\Http\Requests\ListaGanadora as ListaGanadoraRequest;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\ListaGanadora\ListaGanadoraCollection;
use App\Http\Resources\ListaGanadora\ListaGanadoraExcelCollection;
use App\Http\Resources\ListaGanadora\ListaGanadora as ListaGanadoraResource;
use App\Helpers\FileUploader;

class ListaGanadoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_LISTAGANADORA')->only(['create','store']);
        $this->middleware('can:READ_LISTAGANADORA')->only('index');
        $this->middleware('can:UPDATE_LISTAGANADORA')->only(['edit','update']);
        $this->middleware('can:DETAIL_LISTAGANADORA')->only('show');
        $this->middleware('can:DELETE_LISTAGANADORA')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ListaGanadora::filter($request)
            ->with([
                'cargoPostulante',
                'departamento',
                'persona'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ListaGanadoraExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'listas_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ListaGanadoraCollection($query->sort()->paginate());
        //return $query->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListaGanadoraRequest $request, FileUploader $fileUploader)
    {
        $all = $request->all();
        if ( $request->has('credential_comite_electoral') ) {
            $all['credential_comite_electoral'] = $fileUploader->upload( $request->file('credential_comite_electoral'), 'documentos/credentials');
        }
        $listaGanadora = ListaGanadora::create( $all );
        return response()->json($listaGanadora, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return \Illuminate\Http\Response
     */
    public function show(ListaGanadora $listaGanadora)
    {
        return new ListaGanadoraResource($listaGanadora);
        //return $listaGanadora;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListaGanadora  $listaGanadora
     * @return \Illuminate\Http\Response
     */
    public function update(ListaGanadoraRequest $request, ListaGanadora $listaGanadora)
    {
        $listaGanadora->update( $request->all() );
        return response()->json($listaGanadora, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListaGanadora  $listaGanadora
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListaGanadora $listaGanadora)
    {
        $listaGanadora->delete();
        return response()->json(null, 204);
    }
}
