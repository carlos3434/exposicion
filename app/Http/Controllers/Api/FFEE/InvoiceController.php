<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Http\Request;

use App\Http\Requests\Invoice as InvoiceRequest;
use App\Http\Resources\Invoice\InvoiceCollection;
use App\Http\Resources\Invoice\InvoiceExcelCollection;
use App\Http\Resources\Invoice\Invoice as InvoiceResource;

//repositories
use App\Repositories\ClienteRepository;

class InvoiceController extends Controller
{
    private $clienteRepository;
    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
        $this->middleware('can:CREATE_INVOICE')->only(['create','store']);
        $this->middleware('can:READ_INVOICE')->only('index');
        $this->middleware('can:UPDATE_INVOICE')->only(['edit','update']);
        $this->middleware('can:DETAIL_INVOICE')->only('show');
        $this->middleware('can:DELETE_INVOICE')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Invoice::filter($request)
            ->with([
                'tipoDocumentoPago',
                'tipoOperacion',
                'serie',
                'cliente',
                'empresa'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ($query->count() > 0) {
                $result = new InvoiceExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'invoices_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }
        return new InvoiceCollection($query->sort()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $cliente = $this->clienteRepository->newOne($request->cliente);

        $invoice = $request->request->add(['cliente_id' => $cliente->id]);
        $invoice = Invoice::create($request->all());
        return response()->json($invoice, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
        //return $invoice;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update( $request->all() );
        return response()->json($invoice, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response()->json(null, 204);
    }
}
