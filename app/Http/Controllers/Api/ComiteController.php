<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Comite;
use Illuminate\Http\Request;
use App\Http\Requests\Comite as ComiteRequest;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\Comite\ComiteCollection;
use App\Http\Resources\Comite\ComiteExcelCollection;
use App\Http\Resources\Comite\Comite as ComiteResource;

class ComiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_COMITES')->only(['create','store']);
        $this->middleware('can:READ_COMITES')->only('index');
        $this->middleware('can:UPDATE_COMITES')->only(['edit','update']);
        $this->middleware('can:DETAIL_COMITES')->only('show');
        $this->middleware('can:DELETE_COMITES')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Comite::filter($request)
            ->with([
                'persona',
                'cargoPostulante'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ComiteExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'comites_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ComiteCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComiteRequest $request)
    {
        $comite = Comite::create($request->all());
        return response()->json($comite, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function show(Comite $comite)
    {
        return new ComiteResource($comite);
        //return $comite;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function update(ComiteRequest $request, Comite $comite)
    {
        $comite->update( $request->all() );
        return response()->json($comite, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comite $comite)
    {
        $comite->delete();
        return response()->json(null, 204);
    }
}
