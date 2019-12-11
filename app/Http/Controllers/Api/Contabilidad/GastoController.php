<?php

namespace App\Http\Controllers\API\Contabilidad;


use App\Http\Controllers\Controller;
use App\Gasto;
use Illuminate\Http\Request;


use App\Http\Requests\Gasto as GastoRequest;
use App\Http\Resources\Gasto\GastoCollection;
use App\Http\Resources\Gasto\GastoExcelCollection;
use App\Http\Resources\Gasto\Gasto as GastoResource;

//repositories
use App\Repositories\Interfaces\GastoRepositoryInterface;
use App\Repositories\Interfaces\GastoDetailRepositoryInterface;


class GastoController extends Controller
{
    private $gastoRepository;
    private $gastoDetailRepository;
    public function __construct(
        gastoRepositoryInterface $gastoRepository,
        gastoDetailRepositoryInterface $gastoDetailRepository
    )
    {
        $this->gastoRepository = $gastoRepository;
        $this->gastoDetailRepository = $gastoDetailRepository;
        $this->middleware('can:CREATE_GASTOS')->only(['create','store']);
        $this->middleware('can:READ_GASTOS')->only('index');
        $this->middleware('can:UPDATE_GASTOS')->only(['edit','update']);
        $this->middleware('can:DETAIL_GASTOS')->only('show');
        $this->middleware('can:DELETE_GASTOS')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Gasto::filter($request)
            ->with([
                'persona',
                'cargo',
                'departamento'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new GastoExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'gastos_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new GastoCollection($query->sort()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GastoRequest $request)
    {
        $gastoDetail = $request->gastoDetail;
        $gasto = $this->gastoRepository->newOne($request->all());

        if (isset($gastoDetail)) {
            foreach($gastoDetail as $key => $detail)
            {
                //$gasto-id;
                $detail['gasto_id']       = $gasto->id;
                $this->gastoDetailRepository->newOne($detail);
            }
        }


        return new GastoResource($gasto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
