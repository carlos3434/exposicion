<?php

namespace App\Http\Controllers\Api\Tipos;

use App\CargoPostulante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CargoPostulanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_CARGOPOSTULANTE')->only(['create','store']);
        $this->middleware('can:READ_CARGOPOSTULANTE')->only('index');
        $this->middleware('can:UPDATE_CARGOPOSTULANTE')->only(['edit','update']);
        $this->middleware('can:DETAIL_CARGOPOSTULANTE')->only('show');
        $this->middleware('can:DELETE_CARGOPOSTULANTE')->only('destroy');
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

        $query = CargoPostulante::orderBy($sortBy,$direction);

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
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function show(Comite $comite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comite $comite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comite $comite)
    {
        //
    }
}
