<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Empresa;
use Illuminate\Http\Request;

use App\Http\Requests\Empresa as EmpresaRequest;
use App\Http\Resources\Empresa\EmpresaCollection;
use App\Http\Resources\Empresa\EmpresaExcelCollection;
use App\Http\Resources\Empresa\Empresa as EmpresaResource;

use App\Helpers\FileUploader;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_EMPRESA')->only(['create','store']);
        $this->middleware('can:READ_EMPRESA')->only('index');
        $this->middleware('can:UPDATE_EMPRESA')->only(['edit','update']);
        $this->middleware('can:DETAIL_EMPRESA')->only('show');
        $this->middleware('can:DELETE_EMPRESA')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Empresa::filter($request)
            ->with([
                'ubigeo'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new EmpresaExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'empresas_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new EmpresaCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request, FileUploader $fileUploader)
    {
        $all = $request->all();
        if ( $request->has('certificado_digital') ) {
            $all['certificado_digital'] = $fileUploader->upload( $request->file('certificado_digital'), 'certificados');
        }
        if ( $request->has('logo') ) {
            $all['logo'] = $fileUploader->upload( $request->file('logo'), 'logos');
        }
        $empresa = Empresa::create( $all );
        return response()->json($empresa, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return new EmpresaResource($empresa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaRequest $request, Empresa $empresa, FileUploader $fileUploader)
    {
        $all = $request->all();
        if ( $request->has('certificado_digital') ) {
            $all['certificado_digital'] = $fileUploader->upload( $request->file('certificado_digital'), 'certificados');
        }
        if ( $request->has('logo') ) {
            $all['logo'] = $fileUploader->upload( $request->file('logo'), 'logos');
        }
        $empresa->update( $all );
        return response()->json($empresa, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return response()->json(null, 204);
    }
}
