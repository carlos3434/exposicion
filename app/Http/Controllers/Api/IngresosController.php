<?php
namespace App\Http\Controllers\Api;
use DB;
use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Persona\PersonaExcelCollection;

class IngresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:READ_INGRESOS')->only('reporte');
    }

    /**
     * Display a listing of the resource.
     * Buscador de Colegiados para el modulo de Secretaria: lista de Colegiados: buscar por filtros
     *
     * @return \Illuminate\Http\Response
     */
    public function reporte(Request $request)
    {
        $result = Invoice::select(
            'u.name as departamento',
            'invoices.fecha_emision as fecha_pago',
            's.name as serie',
            'invoices.numero',
            'id.valor_venta',
            'id.descripcion',
            'per.numero_documento_identidad as numeroDocumento',
            'per.numero_cmvp as numeroColegiado',
            DB::raw("concat( per.nombres,' ',per.apellido_paterno , ' ', per.apellido_materno ) as persona")
        )
        ->join('series as s','invoices.serie_id','=','s.id')
        ->join('invoice_detail as id','invoices.id','=','id.invoice_id')
        ->join('personas as per','invoices.persona_id','=','per.id')
        ->join('pagos as p','id.pago_id','=','p.id')
        ->join('ubigeos as u','p.departamento_id','=','u.id')
        ->where('invoices.is_nota',0)
        ->where('invoices.cdr_path','<>','')
        ->when($request->has('departamento_id'), function ($query) use ($request) {
            return $query->where('p.departamento_id', $request->departamento_id );
        })
        ->when($request->has('fecha_inicio'), function ($query) use ($request)  {
            return $query->where('invoices.fecha_emision','>=', $request->fecha_inicio );
        })
        ->when($request->has('fecha_fin'), function ($query) use ($request)  {
            return $query->where('invoices.fecha_emision','<=', $request->fecha_fin );
        })
        ->get();

        return $result->downloadExcel(
            'ingresos_'.date('m-d-Y_hia').'.xlsx',
            $writerType = null,
            $headings = true
        );

    }

}
