<?php

namespace App\Http\Controllers\Api;

use App\Licencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Licencia as LicenciaRequest;
//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\Licencia\LicenciaCollection;
use App\Http\Resources\Licencia\LicenciaExcelCollection;
use App\Http\Resources\Licencia\Licencia as LicenciaResource;

class LicenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_LICENCIA')->only(['create','store']);
        $this->middleware('can:READ_LICENCIA')->only('index');
        $this->middleware('can:UPDATE_LICENCIA')->only(['edit','update']);
        $this->middleware('can:DETAIL_LICENCIA')->only('show');
        $this->middleware('can:DELETE_LICENCIA')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 25);
        $sortBy = $request->input('sortBy', 'id');
        $direction = $request->input('direction', 'DESC');

        $name='licencias_'.date('m-d-Y_hia');
        $query = Licencia::filter($request)
            ->with([
                'persona',
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new LicenciaExcelCollection( $query->get() );

                return $result->downloadExcel(
                    $name.'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new LicenciaCollection($query->paginate($per_page));
        //return $query->paginate($per_page);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LicenciaRequest $request)
    {
        $licencia = Licencia::create($request->all());
        return response()->json($licencia, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function show(Licencia $licencia)
    {
        return new LicenciaResource($licencia);
        //return $licencia;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function update(LicenciaRequest $request, Licencia $licencia)
    {
        $licencia->update( $request->all() );
        return response()->json($licencia, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licencia $licencia)
    {
        $licencia->delete();
        return response()->json(null, 204);
    }
}
