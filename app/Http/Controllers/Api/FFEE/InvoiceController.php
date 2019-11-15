<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Http\Request;

use Greenter\Ws\Services\SunatEndpoints;
use Greenter\See;

use App\Http\Requests\Invoice as InvoiceRequest;
use App\Http\Resources\Invoice\InvoiceCollection;
use App\Http\Resources\Invoice\InvoiceExcelCollection;
use App\Http\Resources\Invoice\Invoice as InvoiceResource;

use App\Http\Requests\Cliente as ClienteRequest;
use Illuminate\Support\Facades\Validator;
//repositories
use App\Repositories\Interfaces\ClienteRepositoryInterface;
use App\Repositories\Interfaces\InvoiceDetailRepositoryInterface;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\EmpresaRepositoryInterface;
use App\Repositories\Interfaces\UbigeoRepositoryInterface;

use App\Helpers\Util;
use App\Concepto;

class InvoiceController extends Controller
{
    private $clienteRepository;
    private $invoiceDetailRepository;
    private $invoiceRepository;
    private $empresaRepository;
    private $ubigeoRepository;
    public function __construct(
        ClienteRepositoryInterface $clienteRepository,
        InvoiceDetailRepositoryInterface $invoiceDetailRepository,
        InvoiceRepositoryInterface $invoiceRepository,
        EmpresaRepositoryInterface $empresaRepository,
        UbigeoRepositoryInterface $ubigeoRepository
    )
    {
        $this->clienteRepository = $clienteRepository;
        $this->invoiceDetailRepository = $invoiceDetailRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->empresaRepository = $empresaRepository;
        $this->ubigeoRepository = $ubigeoRepository;
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
        $invoiceDetail = $request->invoiceDetail;
        $cliente = $request->cliente;

        $clienteDB = $this->clienteRepository->getByDni($cliente);

        $request->merge([ 'cliente_id' => $clienteDB->id ]);

        $invoice = Invoice::create($request->all());

        $porcentajeIGV = 18;
        $igvTotal = $descuentoTotal = $valorVentaTotal = 0;
        $montoGravada = $montoGratuito = $montoExogerado = $montoInafecta = 0;
        foreach($invoiceDetail as $key => $detail)
        {
            if (!isset($detail['descuento_linea'])) {
                $detail['descuento_linea'] = 0;
            }
            $igvL = 0;
            $detail['concepto_id']      = $detail['concepto_pago_id'];
            $concepto = Concepto::find($detail['concepto_id']);
            $detail['porcentaje_igv'] = 0;
            $valorVenta = $detail['precio']  * $detail['cantidad'] - $detail['descuento_linea'] ;

            $descuentoTotal += $detail['descuento_linea'];
            $valorVentaTotal += $valorVenta;

            $detail['valor_unitario']   = $detail['precio'] ;
            $detail['precio_unitario']  = $detail['precio'] + ( $igvL - $detail['descuento_linea']) / $detail['cantidad'] ;

            if ($concepto && $concepto->tipo_afecta_igv == Concepto::GRAVADA) {
                $montoGravada += $detail['precio'] * $detail['cantidad'];
                $igvL = $porcentajeIGV/100 * $valorVenta;
                $igvTotal += $igvL;
                $detail['porcentaje_igv']   = $porcentajeIGV;
            }
            //Validando Gratuito
            if ($concepto && $concepto->tipo_afecta_igv == Concepto::GRATUITA) {
                $montoGratuito += $detail['precio'] * $detail['cantidad'];
                $igvL = $porcentajeIGV/100 * $valorVenta;
                $igvTotal += $igvL;
                $detail['porcentaje_igv']   = $porcentajeIGV;
                $detail['valor_unitario'] = 0;
                $detail['precio_unitario'] = 0;
            }
            if ($concepto && $concepto->tipo_afecta_igv == Concepto::EXONERADA) {
                $montoExogerado += $detail['precio'] * $detail['cantidad'];
            }
            if ($concepto && $concepto->tipo_afecta_igv == Concepto::INAFECTA) {
                $montoInafecta += $detail['precio'] * $detail['cantidad'];
            }
            $detail['valor_venta']      = $valorVenta;
            $detail['igv']              = $igvL;
            $detail['impuestos']        = $igvL;
            $detail['base_igv']         = $valorVenta;
            //$invoice->invoiceDetail->save( $detail );
            $detail['invoice_id']       = $invoice->id;
            $this->invoiceDetailRepository->newOne($detail);
        }
        $invoice->valor_venta = $valorVentaTotal;
        $invoice->monto_importe_total_venta = $valorVentaTotal + $igvTotal;
        $invoice->monto_gravada = $montoGravada;
        $invoice->monto_gratuito = $montoGratuito;
        $invoice->monto_exogerado = $montoExogerado;
        $invoice->monto_inafecta = $montoInafecta;
        $invoice->descuento_total = $descuentoTotal;
        $invoice->igv_total = $igvTotal;
        $invoice->save();
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
    public function envioSunat(request $request, $invoiceId)
    {
        //consulta invoice y envio a sunat
        $comprobantePago = $this->invoiceRepository->getById($invoiceId);

        $ubigeo = $this->ubigeoRepository->getByProvinciaId( $comprobantePago->empresa->ubigeo_id);

        //armar company con helper
        $util = Util::getInstance();

        $company = $util->setCompany( array_merge($comprobantePago->empresa->toArray(), $ubigeo) );
        $client = $util->setClient( $comprobantePago->cliente );
        $invoice = $util->setInvoice($comprobantePago , $company , $client);
        $util->setEmpresa($comprobantePago->empresa);

        try {
            $pdf = $util->getPdf($invoice);
            $util->writePdf( $invoice , $pdf );
        } catch (Exception $e) {
            var_dump($e);
        }
        // Envio a SUNAT.
        $see = $util->getSee(SunatEndpoints::FE_BETA);
        $res = $see->send($invoice);
        $util->writeXml($invoice, $see->getFactory()->getLastXml());
        if ($res->isSuccess()) {
            $cdr = $res->getCdrResponse();
            $util->writeCdr($invoice, $res->getCdrZip());
            //$util->showResponse($invoice, $cdr);
        } else {
            $error = [
                'Código' => $res->getError()->getCode(),
                'Descripción' => $res->getError()->getMessage()
            ];
            //echo $util->getErrorResponse($res->getError());
            return response()->json( $error, 500);
        }

        $comprobantePago = $this->invoiceRepository->updatePaths($comprobantePago, $invoice);
        //actualizar envio sunat
        //$invoice = $this->invoiceRepository->envioSunat($invoiceId);
        return response()->json($comprobantePago, 200);
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
