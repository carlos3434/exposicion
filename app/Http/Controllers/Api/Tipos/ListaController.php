<?php

namespace App\Http\Controllers\Api\Tipos;

use App\TipoDocumentoPago;
use App\TipoDocumentoIdentidad;
use App\TipoRendicion;

use App\Http\Resources\Rendicion\TipoDocumentoPagoCollection;
use App\Http\Resources\Rendicion\TipoDocumentoIdentidadCollection;
use App\Http\Resources\Rendicion\TipoRendicionCollection;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:READ_RENDICION')->only('rendiciones');
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
}
