<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Cliente;
use Illuminate\Http\Request;

use App\Http\Requests\Cliente as ClienteRequest;
use App\Http\Resources\Cliente\ClienteCollection;
use App\Http\Resources\Cliente\ClienteExcelCollection;
use App\Http\Resources\Cliente\Cliente as ClienteResource;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_CLIENTE')->only(['create','store']);
        $this->middleware('can:READ_CLIENTE')->only('index');
        $this->middleware('can:UPDATE_CLIENTE')->only(['edit','update']);
        $this->middleware('can:DETAIL_CLIENTE')->only('show');
        $this->middleware('can:DELETE_CLIENTE')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Cliente::filter($request)
            ->with([
                'persona',
                'cargoPostulante'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ClienteExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'Clientes_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ClienteCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $cliente = Cliente::create($request->all());
        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return new ClienteResource($cliente);
        //return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update( $request->all() );
        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response()->json(null, 204);
    }
}
