<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Serie;
use Illuminate\Http\Request;

use App\Http\Requests\Serie as SerieRequest;
use App\Http\Resources\Serie\SerieCollection;
use App\Http\Resources\Serie\SerieExcelCollection;
use App\Http\Resources\Serie\Serie as SerieResource;

class SerieController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_SERIE')->only(['create','store']);
        $this->middleware('can:READ_SERIE')->only('index');
        $this->middleware('can:UPDATE_SERIE')->only(['edit','update']);
        $this->middleware('can:DETAIL_SERIE')->only('show');
        $this->middleware('can:DELETE_SERIE')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Serie::filter($request)
            ->with([
                'persona',
                'cargoPostulante'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new SerieExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'series_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new SerieCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SerieRequest $request)
    {
        $serie = Serie::create($request->all());
        return response()->json($serie, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        return new SerieResource($serie);
        //return $serie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(SerieRequest $request, Serie $serie)
    {
        $serie->update( $request->all() );
        return response()->json($serie, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        $serie->delete();
        return response()->json(null, 204);
    }
}
