<?php
namespace App\Http\Controllers\Api;

use DB;
use App\EstadoPago;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Exports\DeudasExport;
use Maatwebsite\Excel\Facades\Excel;

class DeudasController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:READ_DEUDAS')->only('reporte');
    }

    /**
     * Display a listing of the resource.
     * Buscador de Colegiados para el modulo de Secretaria: lista de Colegiados: buscar por filtros
     *
     * @return \Illuminate\Http\Response
     */

    public function reporte(Request $request, DeudasExport $export)
    {
        $name = 'deudas_'.date('m-d-Y_hia').'.xlsx';
        $type = '.xlsx';
        return Excel::download($export, $name. $type);
    }
}
