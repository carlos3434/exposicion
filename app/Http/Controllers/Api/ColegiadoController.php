<?php
namespace App\Http\Controllers\Api;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Persona\PersonaPagosCollection;

class ColegiadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_REGISTRO')->only(['create','store']);
        $this->middleware('can:READ_REGISTRO')->only('index');
        $this->middleware('can:UPDATE_REGISTRO')->only(['edit','update']);
        $this->middleware('can:DETAIL_REGISTRO')->only('show');
        $this->middleware('can:DELETE_REGISTRO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     * Buscador de Colegiados para el modulo de Secretaria: lista de Colegiados: buscar por filtros
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         return  Persona::filter($request)->first();
    }
    /**
     * Display a listing of the resource.
     * Buscador de Personas y sus deudas para el omdulo de Facturacion Electronica
     *
     * @return \Illuminate\Http\Response
     */
    public function personasPagos(Request $request)
    {
        $persona = Persona::filter($request)
        //->with('pagos.concepto')
        ->with(["pagos" => function($q){
            $q->where('pagos.estado_pago_id', '=', 1);
        }])
        ->get();
        return new PersonaPagosCollection( $persona );
        return $persona;
    }

}
