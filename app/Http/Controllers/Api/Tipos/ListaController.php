<?php

namespace App\Http\Controllers\Api\Tipos;

use App\TipoDocumentoPago;
use App\TipoDocumentoIdentidad;
use App\TipoRendicion;
use App\Responsable;
use App\TipoInventario;
use App\EstadoInventario;

use App\Http\Resources\Rendicion\TipoDocumentoPagoCollection;
use App\Http\Resources\Rendicion\TipoDocumentoIdentidadCollection;
use App\Http\Resources\Rendicion\TipoRendicionCollection;


use App\Http\Resources\Inventario\ResponsableCollection;
use App\Http\Resources\Inventario\TipoInventarioCollection;
use App\Http\Resources\Inventario\EstadoInventarioCollection;


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
        ];
        return response()->json($response, 200);
    }
    public function inventarios()
    {
        $response = [
            'responsable' => new ResponsableCollection( Responsable::all() ),
            'tipoInventario' => new TipoInventarioCollection( TipoInventario::all() ),
            'estadoInventario' => new EstadoInventarioCollection( EstadoInventario::all() ),
        ];
        return response()->json($response, 200);
    }
}
