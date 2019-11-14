<?php

namespace App\Http\Controllers\Api\Tipos;

use App\TipoDocumentoPago;
use App\TipoDocumentoIdentidad;
use App\TipoRendicion;
use App\Responsable;
use App\TipoInventario;
use App\EstadoInventario;
use App\ConceptoCobro;
use App\Concepto;
use App\CargoPostulante;
use App\TipoGasto;

use App\Http\Resources\Rendicion\TipoDocumentoPagoCollection;
use App\Http\Resources\Rendicion\TipoDocumentoIdentidadCollection;
use App\Http\Resources\Rendicion\TipoRendicionCollection;
use App\Http\Resources\Rendicion\ConceptoCobroCollection;


use App\Http\Resources\Inventario\ResponsableCollection;
use App\Http\Resources\Inventario\TipoInventarioCollection;
use App\Http\Resources\Inventario\EstadoInventarioCollection;

use App\Http\Resources\Presupuesto\ConceptoCollection;
use App\Http\Resources\Gasto\CargoPostulanteCollection;
use App\Http\Resources\Gasto\TipoGastoCollection;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:READ_RENDICION')->only('rendiciones');
        $this->middleware('can:READ_INVENTARIO')->only('inventarios');
    }

    public function rendiciones()
    {
        $response = [
            'tipoDocumentoPago' => new TipoDocumentoPagoCollection( TipoDocumentoPago::all() ),
            'tipoDocumentoIdentidad' => new TipoDocumentoIdentidadCollection( TipoDocumentoIdentidad::all() ),
            'tipoRendicion' => new TipoRendicionCollection( TipoRendicion::all() ),
            'conceptos' => new ConceptoCollection( Concepto::where('tipo',1)->get() ),
        ];
        return response()->json($response, 200);
    }
    public function inventarios()
    {
        $response = [
            //'responsable' => new ResponsableCollection( Responsable::all() ),
            'tipoInventario' => new TipoInventarioCollection( TipoInventario::all() ),
            'estadoInventario' => new EstadoInventarioCollection( EstadoInventario::all() ),
        ];
        return response()->json($response, 200);
    }
    public function presupuestos()
    {
        $response = [
            //'responsable' => new ResponsableCollection( Responsable::all() ),
            'tipoPresupuesto' => new TipoInventarioCollection( TipoInventario::all() ),
            'conceptos' => new ConceptoCollection( Concepto::all() ),
        ];
        return response()->json($response, 200);
    }
    public function cajachica()
    {
        $response = [
            'tipoDocumentoPago' => new TipoDocumentoPagoCollection( TipoDocumentoPago::all() ),
            'conceptos' => new ConceptoCollection( Concepto::where('tipo',0)->get() ),
        ];
        return response()->json($response, 200);
    }
    public function invoices()
    {
        $response = [
            'tipoDocumentoPago' => new TipoDocumentoPagoCollection( TipoDocumentoPago::whereIn('codigo_sunat',['01', '03'])->get() ),
            'tipoDocumentoIdentidad' => new TipoDocumentoIdentidadCollection( TipoDocumentoIdentidad::whereIn('codigo_sunat',[1, 6])->get() ),
            'conceptos' => new ConceptoCollection( Concepto::where('tipo',0)->get() ),
        ];
        return response()->json($response, 200);
    }
    public function gastos()
    {
        $response = [
            'tipoDocumentoPago' => new TipoDocumentoPagoCollection( TipoDocumentoPago::all() ),
            'cargoPostulante' => new CargoPostulanteCollection( CargoPostulante::all() ),
            'tipoGasto' => new TipoGastoCollection( TipoGasto::all() ),
            'conceptos' => new ConceptoCollection( Concepto::where('tipo', 1)->get() ),
        ];
        return response()->json($response, 200);
    }
}
