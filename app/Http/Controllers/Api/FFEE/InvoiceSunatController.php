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
use App\Helpers\MonthLetter;

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
        $this->middleware('can:SEND_NOTACREDITO')->only('notaCredito');
        $this->middleware('can:SEND_NOTADEBITO')->only('notaDebito');
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
                $persona = $invoiceDetail->pago->persona;

                $numero_meses_aportado  = $persona->numero_meses_aportado  - 1;
                $numero_meses_deuda     = $persona->numero_meses_deuda     + 1;
                $total_aportado         = $persona->total_aportado      - $invoiceDetail->precio;
                $total_faf              = $persona->total_faf           - 0.25 * $invoiceDetail->precio;
                $total_departamental    = $persona->total_departamental - 0.55 * $invoiceDetail->precio;
                $total_consejo          = $persona->total_consejo       - 0.20 * $invoiceDetail->precio;

                $invoiceDetail->pago->persona->update([
                    'total_aportado' => $total_aportado,
                    'total_faf' => $total_faf,
                    'total_departamental' => $total_departamental,
                    'total_consejo' => $total_consejo,
                ]);

                if (isset( $invoiceDetail->pago_id )) {
                    $this->pagoRepository->updateEstadoPago( $invoiceDetail->pago_id,  EstadoPago::PENDIENTE );
                    //si el pago es primera cuota

                    if ( $invoiceDetail->concepto->id == Concepto::CUOTA ) {
                        if ($invoiceDetail->concepto->pago->is_primera_cuota == true) {
                            $invoiceDetail->concepto->pago->persona->update(['is_habilitado'=>false]);
                        }
                        //aumentar numero de meses aportados
                        $personaArray = array_merge($personaArray , ['numero_meses_aportado' => $numero_meses_aportado]);
                        $personaArray = array_merge($personaArray , ['numero_meses_deuda'    => $numero_meses_deuda]);
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
    public function notaDebito(NotaRequest $request)
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

                $mes_cuota = $invoiceDetail->pago->mes_cuota;
                $persona = $invoiceDetail->pago->persona;

                $numero_meses_aportado  = $persona->numero_meses_aportado  + 1;
                $numero_meses_deuda     = $persona->numero_meses_deuda     - 1;
                $ultimo_mes_pago        = $mes_cuota + 1;
                $total_aportado         = $persona->total_aportado      + $invoiceDetail->precio;
                $total_faf              = $persona->total_faf           + 0.25 * $invoiceDetail->precio;
                $total_departamental    = $persona->total_departamental + 0.55 * $invoiceDetail->precio;
                $total_consejo          = $persona->total_consejo       + 0.20 * $invoiceDetail->precio;

                $personaArray = [
                    'total_aportado' => $total_aportado,
                    'total_faf' => $total_faf,
                    'total_departamental' => $total_departamental,
                    'total_consejo' => $total_consejo,
                ];

                if (isset( $invoiceDetail->pago_id )) {
                    $this->pagoRepository->updateEstadoPago( $invoiceDetail->pago_id,  EstadoPago::COMPLETADA );

                    if ( $invoiceDetail->concepto_id == Concepto::CUOTA  ) {
                        if ( $invoiceDetail->pago->is_primera_cuota == true ) {
                            $invoiceDetail->pago->persona->update();
                            $personaArray = array_merge( $personaArray , ['is_habilitado'=>1]);
                        }
                        //aumentar numero de meses aportados
                        $personaArray = array_merge($personaArray , ['numero_meses_aportado' => $numero_meses_aportado]);
                        $personaArray = array_merge($personaArray , ['numero_meses_deuda'    => $numero_meses_deuda]);
                        $personaArray = array_merge($personaArray , ['ultimo_mes_pago'    => $ultimo_mes_pago]);
                    }
                }
                $invoiceDetail->pago->persona->update($personaArray);
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
