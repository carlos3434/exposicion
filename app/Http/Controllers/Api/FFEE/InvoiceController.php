<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Http\Request;

use App\Http\Requests\Invoice as InvoiceRequest;
use App\Http\Requests\InvoiceUpdate as InvoiceUpdateRequest;
use App\Http\Resources\Invoice\InvoiceCollection;
use App\Http\Resources\Invoice\InvoiceExcelCollection;
use App\Http\Resources\Invoice\Invoice as InvoiceResource;

use App\Http\Requests\Cliente as ClienteRequest;
//repositories
use App\Repositories\Interfaces\ClienteRepositoryInterface;
use App\Repositories\Interfaces\InvoiceDetailRepositoryInterface;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\EmpresaRepositoryInterface;
use App\Repositories\Interfaces\UbigeoRepositoryInterface;

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
        $this->middleware('can:CREATE_INVOICES')->only(['create','store']);
        $this->middleware('can:READ_INVOICES')->only('index');
        $this->middleware('can:UPDATE_INVOICES')->only(['edit','update']);
        $this->middleware('can:DETAIL_INVOICES')->only('show');
        $this->middleware('can:DELETE_INVOICES')->only('destroy');
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
        $numero = $this->invoiceRepository->getLastNumeroInvoiceBySerie( $request->serie_id , $request->tipo_documento_pago_id );

        $invoiceDetail = $request->invoiceDetail;
        $cliente = $request->cliente;
        $cliente = array_merge($cliente, [ 'persona_id' => $request->persona_id ]);

        $clienteDB = $this->clienteRepository->getByDni($cliente);
        $fecha_emision = date("Y-m-d");
        $fecha_vencimiento = date("Y-m-d");
        $request->merge([ 'fecha_emision' => $fecha_emision ]);
        $request->merge([ 'fecha_vencimiento' => $fecha_vencimiento ]);
        $request->merge([ 'cliente_id' => $clienteDB->id ]);
        $request->merge([ 'numero' => $numero ]);

        $invoice = Invoice::create($request->all());

        $porcentajeIGV = 18;
        $igvTotal = $descuentoTotal = $valorVentaTotal = 0;
        $montoGravada = $montoGratuito = $montoExogerado = $montoInafecta = 0;
        foreach($invoiceDetail as $key => $detail)
        {
            $igvL = 0;
            $detail['concepto_id']      = $detail['concepto_pago_id'];
            $concepto = Concepto::find($detail['concepto_id']);

            $valorVenta = $detail['precio']  * $detail['cantidad'] - $detail['descuento_linea'] ;

            $descuentoTotal += $detail['descuento_linea'];
            $valorVentaTotal += $valorVenta;

            $detail['porcentaje_igv'] = 0;
            $detail['valor_unitario']   = $detail['precio'] ;
            $detail['precio_unitario']  = $detail['precio'] + ( $igvL - $detail['descuento_linea']) / $detail['cantidad'] ;

            if ($concepto && $concepto->tipo_afecta_igv == Concepto::GRAVADA) {
                $montoGravada += $detail['precio'] * $detail['cantidad'];
                $igvL = $porcentajeIGV/100 * $valorVenta;
                $igvTotal += $igvL;
                $detail['porcentaje_igv']   = $porcentajeIGV;
            }
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
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        //validar si la factura se envio a sunat, en este caso no se puede modificar
        if ($this->invoiceRepository->getEstadoInvoice( $invoice )) {
            return response()->json( "no se puede actualizar un comprobante de pago que ha sido enviado a SUNAT", 500);
        }

        $invoiceDetail = $request->invoiceDetail;
        $porcentajeIGV = 18;
        $igvTotal = $descuentoTotal = $valorVentaTotal = 0;
        $montoGravada = $montoGratuito = $montoExogerado = $montoInafecta = 0;
        foreach($invoiceDetail as $key => $detail)
        {
            $igvL = 0;
            $detail['concepto_id']      = $detail['concepto_pago_id'];
            $concepto = Concepto::find($detail['concepto_id']);

            $valorVenta = $detail['precio']  * $detail['cantidad'] - $detail['descuento_linea'] ;

            $descuentoTotal += $detail['descuento_linea'];
            $valorVentaTotal += $valorVenta;

            $detail['porcentaje_igv'] = 0;
            $detail['valor_unitario']   = $detail['precio'] ;
            $detail['precio_unitario']  = $detail['precio'] + ( $igvL - $detail['descuento_linea']) / $detail['cantidad'] ;

            if ($concepto && $concepto->tipo_afecta_igv == Concepto::GRAVADA) {
                $montoGravada += $detail['precio'] * $detail['cantidad'];
                $igvL = $porcentajeIGV/100 * $valorVenta;
                $igvTotal += $igvL;
                $detail['porcentaje_igv']   = $porcentajeIGV;
            }
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
            $detail['invoice_id']       = $invoice->id;

            $this->invoiceDetailRepository->updateById( $detail );
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
        return response()->json( new InvoiceResource($invoice), 200);
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
