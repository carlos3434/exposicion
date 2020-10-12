<?php

namespace App\Http\Controllers\Api\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Inventario;
use App\Http\Requests\Inventario as InventarioRequest;

use App\Http\Resources\Inventario\InventarioCollection;
use App\Http\Resources\Inventario\InventarioExcelCollection;
use App\Http\Resources\Inventario\Inventario as InventarioResource;


use App\Repositories\Interfaces\ResponsableRepositoryInterface;

class InventarioController extends Controller
{
    private $responsableRepository;
    public function __construct(ResponsableRepositoryInterface $responsableRepository)
    {
        $this->responsableRepository = $responsableRepository;
        $this->middleware('can:CREATE_INVENTARIOS')->only(['create','store']);
        $this->middleware('can:READ_INVENTARIOS')->only('index');
        $this->middleware('can:UPDATE_INVENTARIOS')->only(['edit','update']);
        $this->middleware('can:DETAIL_INVENTARIOS')->only('show');
        $this->middleware('can:DELETE_INVENTARIOS')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Inventario::filter($request)
            ->with([
                'responsable',
                'tipoInventario',
                'departamento',
                'estadoInventario'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new InventarioExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'inventarios_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new InventarioCollection($query->sort()->paginate());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventarioRequest $request)
    {
        $responsable = $request->responsable;

        $responsableDB = $this->responsableRepository->getByFullName($responsable);

        $request->merge([ 'responsable_id' => $responsableDB->id ]);

        $inventario = Inventario::create($request->all());
        return new InventarioResource($inventario);
        /*
        $inventario = Inventario::create($request->all());
        return response()->json($inventario, 201);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        return new InventarioResource($inventario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(InventarioRequest $request, Inventario $inventario)
    {
        $inventario->update( $request->all() );
        return new InventarioResource($inventario);
        //return response()->json($inventario, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->delete();
        return response()->json(null, 204);
    }
}
