<?php

namespace App\Http\Controllers\Api\Tipos;

use App\EstadoCuentaSistema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstadoCuentaSistemaController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('can:CREATE_TRANSLADO')->only(['create','store']);
        $this->middleware('can:READ_TRANSLADO')->only('index');
        $this->middleware('can:UPDATE_TRANSLADO')->only(['edit','update']);
        $this->middleware('can:DETAIL_TRANSLADO')->only('show');
        $this->middleware('can:DELETE_TRANSLADO')->only('destroy');
    }*/
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
        $query = EstadoCuentaSistema::orderBy($sortBy,$direction);
        //return $query->paginate($per_page);
        return $query->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\EstadoCuentaSistema  $estadoCuentaSistema
     * @return \Illuminate\Http\Response
     */
    public function show(EstadoCuentaSistema $estadoCuentaSistema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EstadoCuentaSistema  $estadoCuentaSistema
     * @return \Illuminate\Http\Response
     */
    public function edit(EstadoCuentaSistema $estadoCuentaSistema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EstadoCuentaSistema  $estadoCuentaSistema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstadoCuentaSistema $estadoCuentaSistema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EstadoCuentaSistema  $estadoCuentaSistema
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstadoCuentaSistema $estadoCuentaSistema)
    {
        //
    }
}
