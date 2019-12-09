<?php
namespace App\Http\Controllers\Api;
use App\Persona;
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
        $query = Persona::filter($request)
            ->with([
                'tipoDocumentoIdentidad',
                'nacionalidad',
                'estadoCivil',
                'departamento',
                'distrito',
                'provincia',
                'universidadProcedencia',
                'especialidadPosgrado',
                'areaEjercicioProfesional',
                'departamentoColegiado',
                'estadoRegistroColegiado',
                'estadoCuentaSistema'
        ]);

        $result = new PersonaExcelCollection( $query->get() );

        return $result->downloadExcel(
            'registros_'.date('m-d-Y_hia').'.xlsx',
            $writerType = null,
            $headings = true
        );

    }

}
