<?php

namespace App\Http\Controllers\Api\Tipos;

use App\TipoProcesoDisciplinario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoProcesoDisciplinarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_TIPOPROCESODISCIPLINARIO')->only(['create','store']);
        $this->middleware('can:READ_TIPOPROCESODISCIPLINARIO')->only('index');
        $this->middleware('can:UPDATE_TIPOPROCESODISCIPLINARIO')->only(['edit','update']);
        $this->middleware('can:DETAIL_TIPOPROCESODISCIPLINARIO')->only('show');
        $this->middleware('can:DELETE_TIPOPROCESODISCIPLINARIO')->only('destroy');
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

        $query = TipoProcesoDisciplinario::orderBy($sortBy,$direction);

        //return $query->paginate($per_page);
        return $query->get();
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoProcesoDisciplinario  $tipoProcesoDisciplinario
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoProcesoDisciplinario $tipoProcesoDisciplinario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoProcesoDisciplinario  $tipoProcesoDisciplinario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoProcesoDisciplinario $tipoProcesoDisciplinario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoProcesoDisciplinario  $tipoProcesoDisciplinario
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoProcesoDisciplinario $tipoProcesoDisciplinario)
    {
        //
    }
}
