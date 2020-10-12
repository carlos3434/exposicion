<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Rendicion;
use App\Http\Requests\Rendicion as RendicionRequest;

use App\Http\Resources\Rendicion\RendicionCollection;
use App\Http\Resources\Rendicion\RendicionExcelCollection;
use App\Http\Resources\Rendicion\Rendicion as RendicionResource;


class RendicionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_RENDICIONES')->only(['create','store']);
        $this->middleware('can:READ_RENDICIONES')->only('index');
        $this->middleware('can:UPDATE_RENDICIONES')->only(['edit','update']);
        $this->middleware('can:DETAIL_RENDICIONES')->only('show');
        $this->middleware('can:DELETE_RENDICIONES')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Rendicion::filter($request)
            ->with([
                'tipoDocumentoIdentidad',
                'tipoRendicion',
                'tipoDocumentoPago'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new RendicionExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'rendiciones_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new RendicionCollection($query->sort()->paginate());
        //return $query->paginate($per_page);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RendicionRequest $request)
    {
        //$invoiceDetail = $request->invoiceDetail;
        /*$responsable = $request->responsable;

        $responsableDB = $this->responsableRepository->getByFullName($responsable);

        $request->merge([ 'responsable_id' => $responsableDB->id ]);*/

        $rendicion = Rendicion::create($request->all());
        return new RendicionResource($rendicion);
        //return response()->json($rendicion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rendicion  $rendicion
     * @return \Illuminate\Http\Response
     */
    public function show(Rendicion $rendicion)
    {
        return new RendicionResource($rendicion);
        //return $rendicion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rendicion  $rendicion
     * @return \Illuminate\Http\Response
     */
    public function update(RendicionRequest $request, Rendicion $rendicion)
    {
        $rendicion->update( $request->all() );
        return new RendicionResource($rendicion);
        //return response()->json($rendicion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rendicion  $rendicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rendicion $rendicion)
    {
        $rendicion->delete();
        return response()->json(null, 204);
    }
}
