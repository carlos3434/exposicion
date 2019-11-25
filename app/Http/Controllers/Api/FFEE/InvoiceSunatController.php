<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Concepto;
use App\EstadoPago;
use App\TipoDocumentoPago;
use Illuminate\Http\Request;

use Greenter\Ws\Services\SunatEndpoints;

use App\Http\Requests\Nota as NotaRequest;

//repositories
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\UbigeoRepositoryInterface;
use App\Repositories\Interfaces\PagoRepositoryInterface;

use App\Helpers\Util;

class InvoiceSunatController extends Controller
{
    private $invoiceRepository;
    private $ubigeoRepository;
    private $pagoRepository;
    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        UbigeoRepositoryInterface $ubigeoRepository,
        PagoRepositoryInterface $pagoRepository
    )
    {
        $this->invoiceRepository = $invoiceRepository;
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
            //actualizar los pagos pendientes
            foreach ($comprobantePago->invoiceDetail as $key => $invoiceDetail) {
                if (isset( $invoiceDetail->pago_id )) {
                    $this->pagoRepository->updateEstadoPago( $invoiceDetail->pago_id,  EstadoPago::PENDIENTE );
                    //si el pago es primera cuota

                    if ( $invoiceDetail->concepto->id == Concepto::CUOTA && $invoiceDetail->concepto->pago->is_primera_cuota == true ) {

                        $invoiceDetail->concepto->pago->persona->update(['is_habilitado'=>false]);
                    }
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
                //actualizar montos en la tabla personas
                /*$extra = [
                    'total_faf'              => 0.25 * $invoiceDetail->precio,
                    'total_departamental'    => 0.55 * $invoiceDetail->precio,
                    'total_consejo'          => 0.20 * $invoiceDetail->precio
                ];*/
                $persona = $invoiceDetail->pago->persona;
                //dd($persona);
                $total_aportado         = $persona->total_aportado      + $invoiceDetail->precio;
                $total_faf              = $persona->total_faf           + 0.25 * $invoiceDetail->precio;
                $total_departamental    = $persona->total_departamental + 0.55 * $invoiceDetail->precio;
                $total_consejo          = $persona->total_consejo       + 0.20 * $invoiceDetail->precio;
                //$persona->save();

                $invoiceDetail->pago->persona->update([
                    'total_aportado' => $total_aportado,
                    'total_faf' => $total_faf,
                    'total_departamental' => $total_departamental,
                    'total_consejo' => $total_consejo,
                ]);
                //$invoiceDetail->pago->persona->increment('total_aportado', $invoiceDetail->precio, $extra );
                if (isset( $invoiceDetail->pago_id )) {
                    $this->pagoRepository->updateEstadoPago( $invoiceDetail->pago_id,  EstadoPago::COMPLETADA );

//var_dump($invoiceDetail->concepto->id);
//var_dump(Concepto::CUOTA);
//var_dump($invoiceDetail->concepto->pago->is_primera_cuota);
                    if ( $invoiceDetail->concepto_id == Concepto::CUOTA && $invoiceDetail->pago->is_primera_cuota == true ) {
                        $invoiceDetail->pago->persona->update(['is_habilitado'=>1]);
//var_dump( $invoiceDetail->pago->persona  );
                    }
                }
            }
//dd("fin");
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
