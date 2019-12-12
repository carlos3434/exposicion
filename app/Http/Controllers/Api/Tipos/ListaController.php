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
use App\Serie;
use App\TipoNota;
use App\Ubigeo;
use App\Universidad;
use App\EspecialidadPosgrado;
use App\EstadoCivil;

use App\AreaEjercicioProfesional;

use App\Http\Resources\Rendicion\TipoDocumentoPagoCollection;
use App\Http\Resources\Rendicion\TipoDocumentoIdentidadCollection;
use App\Http\Resources\Rendicion\TipoRendicionCollection;
use App\Http\Resources\Rendicion\ConceptoCobroCollection;


use App\Http\Resources\Inventario\ResponsableCollection;
use App\Http\Resources\Inventario\TipoInventarioCollection;
use App\Http\Resources\Inventario\EstadoInventarioCollection;
use App\Http\Resources\TipoNota\TipoNotaCollection;

use App\Http\Resources\Presupuesto\ConceptoCollection;
use App\Http\Resources\Concepto\ConceptoCollection as InvoiceConceptoCollection;
use App\Http\Resources\Gasto\CargoPostulanteCollection;
use App\Http\Resources\Gasto\TipoGastoCollection;

use App\Http\Resources\Ubigeo\UbigeoCollection;
use App\Http\Resources\Serie\SerieCollection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListaController extends Controller
{
    public $departamentos;
    public function __construct()
    {
        $this->middleware('can:READ_RENDICIONES')->only('rendiciones');
        $this->middleware('can:READ_INVENTARIOS')->only('inventarios');
        $this->middleware('can:READ_PRESUPUESTOS')->only('presupuestos');
        $this->middleware('can:READ_CAJACHICA')->only('cajachica');
        $this->middleware('can:READ_GASTOS')->only('gastos');
        //$this->middleware('can:CREATE_INVOICES')->only('invoices');
        //$this->middleware('can:READ_INVOICES')->only('listasInvoices');

    }
    private function getDepartamentos()
    {
        $departamentoId = Auth::user()->departamento_id;

        if ($departamentoId == Ubigeo::PERU) {
            $this->departamentos = Ubigeo::where('level',2)->where('parent_id',2533)->get();
        } else {
            $this->departamentos = Ubigeo::where('id',$departamentoId)->get();
        }
        return $this->departamentos;
    }

    public function rendiciones()
    {
        $response = [
            'departamentos' => new UbigeoCollection( $this->getDepartamentos() ),
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
            'departamentos' => new UbigeoCollection( $this->getDepartamentos() ),
            'tipoInventario' => new TipoInventarioCollection( TipoInventario::all() ),
            'estadoInventario' => new EstadoInventarioCollection( EstadoInventario::all() ),
        ];
        return response()->json($response, 200);
    }
    public function presupuestos()
    {
        $response = [
            'departamentos' => new UbigeoCollection( $this->getDepartamentos() ),
            'tipoPresupuesto' => new TipoPresupuestoCollection( TipoPresupuesto::all() ),
            'conceptos' => new ConceptoCollection( Concepto::all() ),
        ];
        return response()->json($response, 200);
    }
    public function cajachica()
    {
        $response = [
            'departamentos' => new UbigeoCollection( $this->getDepartamentos() ),
            'tipoDocumentoPago' => new TipoDocumentoPagoCollection( TipoDocumentoPago::all() ),
            'conceptos' => new ConceptoCollection( Concepto::where('tipo',1)->get() ),
        ];
        return response()->json($response, 200);
    }
    public function invoices()
    {
        $departamentoId = Auth::user()->departamento_id;
        //
        if ($departamentoId == Ubigeo::PERU) {
            $series = Serie::all();
        } else {
            $series = Serie::where('departamento_id',$departamentoId)->get();
        }

        $response = [
            'departamentos' => new UbigeoCollection( $this->getDepartamentos() ),
            'tipoDocumentoPago' => new TipoDocumentoPagoCollection( TipoDocumentoPago::whereIn('codigo_sunat',['01', '03'])->get() ),
            'tipoDocumentoIdentidad' => new TipoDocumentoIdentidadCollection( TipoDocumentoIdentidad::whereIn('codigo_sunat',[1, 6])->get() ),
            'conceptos' => new InvoiceConceptoCollection( Concepto::where('tipo',0)->get() ),
            'series' => new SerieCollection( $series ),
        ];
        return response()->json($response, 200);
    }
    public function gastos()
    {
        $response = [
            'departamentos' => new UbigeoCollection( $this->getDepartamentos() ),
            'tipoDocumentoPago' => new TipoDocumentoPagoCollection( TipoDocumentoPago::all() ),
            'cargoPostulante' => new CargoPostulanteCollection( CargoPostulante::all() ),
            'tipoGasto' => new TipoGastoCollection( TipoGasto::all() ),
            'conceptos' => new ConceptoCollection( Concepto::where('tipo', 1)->get() ),
        ];
        return response()->json($response, 200);
    }
    public function listasInvoices()
    {
        $departamentoId = Auth::user()->departamento_id;
        //
        if ($departamentoId == Ubigeo::PERU) {
            $series = Serie::all();
        } else {
            $series = Serie::where('departamento_id',$departamentoId)->get();
        }
        $response = [
            'departamentos' => new UbigeoCollection( $this->getDepartamentos() ),
            'series' => new SerieCollection( $series ),
            'tipoDocumentoPago' => new TipoDocumentoPagoCollection( TipoDocumentoPago::whereIn('codigo_sunat',['01', '03','07','08'])->get() ),
            'tipoNota' => new TipoNotaCollection( TipoNota::all() ),
            'conceptos' => new ConceptoCollection( Concepto::where('tipo', 1)->get() ),
        ];
        return response()->json($response, 200);
    }
    public function listasPersonas()
    {
        $response = [
            'especialidadPosgrado' => EspecialidadPosgrado::all() ,
            'areaEjercicioProfesional' => AreaEjercicioProfesional::all(),
            'departamentos' => new UbigeoCollection( $this->getDepartamentos() ),
            'estadoCivil' => EstadoCivil::all(),
            'tipoDocumentoIdentidad' => new TipoDocumentoIdentidadCollection( TipoDocumentoIdentidad::all() ),
            'universidades' => new SerieCollection( Universidad::all() ),
            'nacionalidades' => new UbigeoCollection( Ubigeo::where('level',1)->get() ),

        ];
        return response()->json($response, 200);
    }
}
