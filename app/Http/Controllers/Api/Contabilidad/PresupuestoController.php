<?php

namespace App\Http\Controllers\API\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Presupuesto;
use App\Http\Requests\Presupuesto as PresupuestoRequest;

use App\Http\Resources\Presupuesto\PresupuestoCollection;
use App\Http\Resources\Presupuesto\PresupuestoExcelCollection;
use App\Http\Resources\Presupuesto\Presupuesto as PresupuestoResource;

use App\Exports\PresupuestoExport;
use Maatwebsite\Excel\Facades\Excel;

class PresupuestoController extends Controller
{
    private $excel;
    //public function __construct()
    public function __construct(PresupuestoExport $excel)
    {
        $this->excel = $excel;
        $this->middleware('can:CREATE_PRESUPUESTO')->only(['create','store']);
        $this->middleware('can:READ_PRESUPUESTO')->only('index');
        $this->middleware('can:UPDATE_PRESUPUESTO')->only(['edit','update']);
        $this->middleware('can:DETAIL_PRESUPUESTO')->only('show');
        $this->middleware('can:DELETE_PRESUPUESTO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PresupuestoExport $export)
    {
        $query = Presupuesto::filter($request)
            ->with([
                'departamento',
                'tipoPresupuesto',
                'concepto'
        ]);
        if ( !empty($request->excel) ){
            //$query->select($headings);
            //$rows = $query->get()->toArray();
            //$export = new PresupuestoExport();
            $name = 'Presupuestos_'.date('m-d-Y_hia').'.xlsx';
            $type = '.xlsx';
            //return $excel->download($export, 'invoices.xlsx');
            return Excel::download($export, $name. $type);

            /*$type = ($request->excel) ? '.xlsx' : '.pdf';
            
            $query->select($headings);
            $rows = $query->get()->toArray();
            $export = new PresupuestoExport($rows,$headings);
            return Excel::download($export, $name. $type);
*/
            /*
            $data = array(
                array('data1', 'data2'),
                array('data3', 'data4')
            );

            $this->excel->create('test', function($excel) use ($data) {
                $excel->sheet('Sheetname', function($sheet) use($data) {

                    $sheet->fromArray($data);

                });
            })->export('xls');
            */
/*
            Excel::create('Filename', function($excel) use($data) {

                $excel->sheet('Sheetname', function($sheet) use($data) {

                    $sheet->fromArray($data);

                });

            })->export('xls');*/

/*
            if ($query->count() > 0) {
                $result = new PresupuestoExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'Presupuestos_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }*/
        }
        return new PresupuestoCollection($query->sort()->paginate());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresupuestoRequest $request)
    {
        $presupuesto = Presupuesto::create($request->all());
        return new PresupuestoResource($presupuesto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function show(Presupuesto $presupuesto)
    {
        return new PresupuestoResource($presupuesto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function update(PresupuestoRequest $request, Presupuesto $presupuesto)
    {
        $presupuesto->update( $request->all() );
        return new PresupuestoResource($presupuesto);
        //return response()->json($presupuesto, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presupuesto $presupuesto)
    {
        $presupuesto->delete();
        return response()->json(null, 204);
    }
}
