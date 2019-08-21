<?php

namespace App\Http\Controllers\Api\Tipos;

use App\Ubigeo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Ubigeo\UbigeoCollection;

class UbigeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_UBIGEO')->only(['create','store']);
        $this->middleware('can:READ_UBIGEO')->only('index');
        $this->middleware('can:UPDATE_UBIGEO')->only(['edit','update']);
        $this->middleware('can:DETAIL_UBIGEO')->only('show');
        $this->middleware('can:DELETE_UBIGEO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 25);
        $sortBy = $request->input('sortBy', 'id');
        $direction = $request->input('direction', 'DESC');

        return new UbigeoCollection(
            Ubigeo::filter($request)
                ->get()
                //->orderBy($sortBy,$direction)
                //->paginate($per_page)
        );

        $query = Ubigeo::orderBy($sortBy,$direction);

        return $query->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ubigeo  $ubigeo
     * @return \Illuminate\Http\Response
     */
    public function show(Ubigeo $ubigeo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ubigeo  $ubigeo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ubigeo $ubigeo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ubigeo  $ubigeo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubigeo $ubigeo)
    {
        //
    }
}
