<?php

namespace App\Http\Controllers\Api\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Responsable;
use App\Http\Requests\Responsable as ResponsableRequest;

use App\Http\Resources\Responsable\ResponsableCollection;
use App\Http\Resources\Responsable\ResponsableExcelCollection;
use App\Http\Resources\Responsable\Responsable as ResponsableResource;

class ResponsableController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:CREATE_RESPONSABLE')->only(['create','store']);
        $this->middleware('can:READ_RESPONSABLE')->only('index');
        $this->middleware('can:UPDATE_RESPONSABLE')->only(['edit','update']);
        $this->middleware('can:DETAIL_RESPONSABLE')->only('show');
        $this->middleware('can:DELETE_RESPONSABLE')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Responsable::filter($request);

        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new ResponsableExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'responsables_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new ResponsableCollection($query->sort()->paginate());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResponsableRequest $request)
    {
        $responsable = Responsable::create($request->all());
        return response()->json($responsable, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function show(Responsable $responsable)
    {
        return new ResponsableResource($responsable);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function update(ResponsableRequest $request, Responsable $responsable)
    {
        $responsable->update( $request->all() );
        return response()->json($responsable, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Responsable $responsable)
    {
        $responsable->delete();
        return response()->json(null, 204);
    }
}
