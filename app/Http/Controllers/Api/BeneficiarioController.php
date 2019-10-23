<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Beneficiario;
use Illuminate\Http\Request;
use App\Http\Requests\Beneficiario as BeneficiarioRequest;


use App\Http\Resources\Beneficiario\BeneficiarioCollection;
use App\Http\Resources\Beneficiario\BeneficiarioExcelCollection;
use App\Http\Resources\Beneficiario\Beneficiario as BeneficiarioResource;

class BeneficiarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_BENEFICIARIO')->only(['create','store']);
        $this->middleware('can:READ_BENEFICIARIO')->only('index');
        $this->middleware('can:UPDATE_BENEFICIARIO')->only(['edit','update']);
        $this->middleware('can:DETAIL_BENEFICIARIO')->only('show');
        $this->middleware('can:DELETE_BENEFICIARIO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Beneficiario::filter($request)
            ->with([
                'tipoDocumentoIdentidad',
                'persona'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new BeneficiarioExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'beneficiarios_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new BeneficiarioCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeneficiarioRequest $request)
    {
        $beneficiario = Beneficiario::create($request->all());
        return response()->json($beneficiario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiario $beneficiario)
    {
        return new BeneficiarioResource($beneficiario);
        //return $beneficiario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function update(BeneficiarioRequest $request, Beneficiario $beneficiario)
    {
        $beneficiario->update( $request->all() );
        return response()->json($beneficiario, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiario $beneficiario)
    {
        $beneficiario->update( ['is_baja'=>1] );
        //$beneficiario->delete();
        return response()->json(null, 204);
    }
}
