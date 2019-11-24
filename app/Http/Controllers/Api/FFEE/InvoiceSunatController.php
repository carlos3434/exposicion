<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\TipoDocumentoPago;
use Illuminate\Http\Request;

use Greenter\Ws\Services\SunatEndpoints;
use Greenter\See;

use App\Http\Requests\Invoice as InvoiceRequest;
use App\Http\Requests\Nota as NotaRequest;
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
use App\Repositories\Interfaces\PagoRepositoryInterface;

use App\Helpers\Util;
use App\Concepto;


class InvoiceSunatController extends Controller
{
    private $clienteRepository;
    private $invoiceDetailRepository;
    private $invoiceRepository;
    private $empresaRepository;
    private $ubigeoRepository;
    private $pagoRepository;
    public function __construct(
        ClienteRepositoryInterface $clienteRepository,
        InvoiceDetailRepositoryInterface $invoiceDetailRepository,
        InvoiceRepositoryInterface $invoiceRepository,
        EmpresaRepositoryInterface $empresaRepository,
        UbigeoRepositoryInterface $ubigeoRepository,
        PagoRepositoryInterface $pagoRepository
    )
    {
        $this->clienteRepository = $clienteRepository;
        $this->invoiceDetailRepository = $invoiceDetailRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->empresaRepository = $empresaRepository;
        $this->ubigeoRepository = $ubigeoRepository;
        $this->pagoRepository = $pagoRepository;

        $this->middleware('can:SEND_BOLETAFACTURA')->only('boletaFactura');
        $this->middleware('can:SEND_NOTADEBITO')->only('envioSunatNotaDebito');
        $this->middleware('can:SEND_NOTADEBITO')->only('envioSunatNotaDebito');
    }
    /**
     * notaCredito
     */
    public function notaCredito(NotaRequest $request)
    {
        $invoiceId = $request->invoice_id;
        //consulta invoice
        $comprobantePago = $this->invoiceRepository->getById($invoiceId);

        //crear nota de credito
        $nota = $comprobantePago->replicate();

        //guardar los nuevos campos
        $nota->numero = $this->invoiceRepository->getLastNumeroInvoiceBySerie( $comprobantePago->serie_id , TipoDocumentoPago::NOTA_CREDITO );
        $nota->invoice_id = $request->invoice_id;
        $nota->tipo_nota_id = $request->tipo_nota_id;
        $nota->motivo = $request->motivo;
        $nota->tipo_documento_pago_id = TipoDocumentoPago::NOTA_CREDITO;
        $nota->fecha_emision = date("Y-m-d");
        $nota->save();
        //actualizar el comprobante ya que se emitio una nota
        $comprobantePago->is_nota = 1;
        $comprobantePago->save();

        $ubigeo = $this->ubigeoRepository->getByProvinciaId( $comprobantePago->empresa->ubigeo_id);

        //armar company con helper
        $util = Util::getInstance();

        $util->setCompany( array_merge($comprobantePago->empresa->toArray(), $ubigeo) );
        $util->setClient( $comprobantePago->cliente );
        $notaCredito = $util->setNotaCredito( $comprobantePago );
        $util->setEmpresa($comprobantePago->empresa);

        try {
            $pdf = $util->getPdf($notaCredito);
            $util->writePdf( $notaCredito , $pdf );
        } catch (Exception $e) {
            var_dump($e);
        }
        // Envio a SUNAT.
        $see = $util->getSee(SunatEndpoints::FE_BETA);
        $res = $see->send($notaCredito);
        $util->writeXml($notaCredito, $see->getFactory()->getLastXml());
        if ($res->isSuccess()) {
            $cdr = $res->getCdrResponse();
            $util->writeCdr($notaCredito, $res->getCdrZip());
        } else {
            $error = [
                'Código' => $res->getError()->getCode(),
                'Descripción' => $res->getError()->getMessage()
            ];
            return response()->json( $error, 500);
        }
        //actualizar envio sunat
        $nota = $this->invoiceRepository->updatePaths($comprobantePago->nota, $notaCredito);

        return response()->json($nota, 200);
    }
    /**
     * notaDebito
     */
    public function envioSunatNotaDebito(NotaRequest $request)
    {
        $invoiceId = $request->invoice_id;
        //consulta invoice
        $comprobantePago = $this->invoiceRepository->getById($invoiceId);

        //crear nota de debito
        $nota = $comprobantePago->replicate();

        //guardar los nuevos campos
        $nota->numero = $this->invoiceRepository->getLastNumeroInvoiceBySerie( $comprobantePago->serie_id , TipoDocumentoPago::NOTA_DEBITO );
        $nota->invoice_id = $request->invoice_id;
        $nota->tipo_nota_id = $request->tipo_nota_id;
        $nota->motivo = $request->motivo;
        $nota->tipo_documento_pago_id = TipoDocumentoPago::NOTA_DEBITO;
        $nota->fecha_emision = date("Y-m-d");
        $nota->save();
        //actualizar el comprobante ya que se emitio una nota
        $comprobantePago->is_nota = 1;
        $comprobantePago->save();

        $ubigeo = $this->ubigeoRepository->getByProvinciaId( $comprobantePago->empresa->ubigeo_id);

        //armar company con helper
        $util = Util::getInstance();

        $util->setCompany( array_merge($comprobantePago->empresa->toArray(), $ubigeo) );
        $util->setClient( $comprobantePago->cliente );
        $notaCredito = $util->setNotaCredito( $comprobantePago );
        $util->setEmpresa($comprobantePago->empresa);

        try {
            $pdf = $util->getPdf($notaCredito);
            $util->writePdf( $notaCredito , $pdf );
        } catch (Exception $e) {
            var_dump($e);
        }
        // Envio a SUNAT.
        $see = $util->getSee(SunatEndpoints::FE_BETA);
        $res = $see->send($notaCredito);
        $util->writeXml($notaCredito, $see->getFactory()->getLastXml());
        if ($res->isSuccess()) {
            $cdr = $res->getCdrResponse();
            $util->writeCdr($notaCredito, $res->getCdrZip());
        } else {
            $error = [
                'Código' => $res->getError()->getCode(),
                'Descripción' => $res->getError()->getMessage()
            ];
            return response()->json( $error, 500);
        }
        //actualizar envio sunat
        $nota = $this->invoiceRepository->updatePaths($comprobantePago->nota, $notaCredito);

        return response()->json($nota, 200);
    }
    /**
     * Envio de comprobante a sunat
     */
    public function boletaFactura(request $request, $invoiceId)
    {
        //consulta invoice y envio a sunat
        $comprobantePago = $this->invoiceRepository->getResourceById($invoiceId);

        $ubigeo = $this->ubigeoRepository->getByProvinciaId( $comprobantePago->empresa->ubigeo_id);

        //armar company con helper
        $util = Util::getInstance();

        $util->setCompany( array_merge($comprobantePago->empresa->toArray(), $ubigeo) );
        $util->setClient( $comprobantePago->cliente );
        $invoice = $util->setInvoice($comprobantePago);
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
            //completar los pagos pendientes
            foreach ($comprobantePago->invoiceDetail as $key => $invoiceDetail) {
                if (isset( $invoiceDetail->pago_id )) {
                    $this->pagoRepository->updateEstadoPago( $invoiceDetail->pago_id,  EstadoPago::COMPLETADA );
                }
            }
        } else {
            $error = [
                'Código' => $res->getError()->getCode(),
                'Descripción' => $res->getError()->getMessage()
            ];
            return response()->json( $error, 500);
        }
        //actualizar envio sunat
        $comprobantePago = $this->invoiceRepository->updatePaths($comprobantePago, $invoice);

        return response()->json($comprobantePago, 200);
    }

}
