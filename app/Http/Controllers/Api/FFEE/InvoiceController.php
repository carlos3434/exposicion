<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Http\Request;

use App\Http\Requests\Invoice as InvoiceRequest;
use App\Http\Resources\Invoice\InvoiceCollection;
use App\Http\Resources\Invoice\InvoiceExcelCollection;
use App\Http\Resources\Invoice\Invoice as InvoiceResource;

use App\Http\Requests\Cliente as ClienteRequest;
use Illuminate\Support\Facades\Validator;
//repositories
use App\Repositories\Interfaces\ClienteRepositoryInterface;
use App\Repositories\Interfaces\InvoiceDetailRepositoryInterface;

class InvoiceController extends Controller
{
    private $clienteRepository;
    private $invoiceDetailRepository;
    public function __construct(
        ClienteRepositoryInterface $clienteRepository,
        InvoiceDetailRepositoryInterface $invoiceDetailRepository
    )
    {
        $this->clienteRepository = $clienteRepository;
        $this->invoiceDetailRepository = $invoiceDetailRepository;
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
        //validate cliente
        /*
        $cliente = json_decode($request->cliente,true);
        Validator::make( $cliente , [
            'tipo_documento_identidad_id'        => 'required|integer',
            'numero_documento_identidad'         => 'required|integer',
            'razon_social'                       => 'required|string',
            'direccion'                          => 'required|string',
            'telefono'                           => 'integer',
            'celular'                            => 'integer',
            'email'                              => 'email',
        ])->validate();

        //validate detail
        $invoiceDetail = json_decode($request->invoiceDetail,true);
        foreach($invoiceDetail as $key => $detail)
        {
            Validator::make( $detail , [
                'descripcion'       => 'required|string',
                'precio'            => 'required|integer',
                'cantidad'          => 'required|integer',
                'descuento_linea'   => 'integer',
                'concepto_pago_id'  => 'required|exists:concepto_pago,id',
            ])->validate();
        }*/
        //$cliente = $this->clienteRepository->newOne($request->cliente);
        $invoiceDetail = $request->invoiceDetail;
        $cliente = $request->cliente;

        $clienteDB = $this->clienteRepository->getByDni($cliente);
        $clienteId = $clienteDB['id'];
        if ( empty($clienteDB) ) {
            $clienteId = $this->clienteRepository->newOne( $cliente );
        }

        $request->request->add(['cliente_id' => $clienteId]);

        $invoice = Invoice::create($request->all());

        foreach($invoiceDetail as $key => $detail)
        {
            $detail['invoice_id'] = $invoice->id;
            $this->invoiceDetailRepository->newOne($detail);
        }
        return new InvoiceResource($invoice);
        //return response()->json($invoice, 201);
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
