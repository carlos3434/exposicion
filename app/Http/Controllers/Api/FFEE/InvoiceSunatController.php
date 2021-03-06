<?php

namespace App\Http\Controllers\Api\FFEE;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Concepto;
use App\EstadoPago;
use App\Pago;
use App\PersonaInhabilitada;
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

        if ( !($comprobantePago->tipo_documento_pago_id == 1 || $comprobantePago->tipo_documento_pago_id == 2) ) {
            return response()->json( "no se puede generar Nota de un comprobante que no es Boleta y/o Factura", 500);
        }
        if ( $comprobantePago->is_nota == 1 ) {
            return response()->json( "El comprobante ya tiene una Nota Generado", 500);
        }
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
        $nota->afectado->update(['is_nota' => 1]);

        $ubigeo = $this->ubigeoRepository->getByDistritoId( $comprobantePago->empresa->ubigeo_id);

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
            return var_dump($e);
        }
        // Envio a SUNAT.
        $see = $util->getSee('');
        $res = $see->send($notaCredito);
        $util->writeXml($notaCredito, $see->getFactory()->getLastXml());

        if ($res->isSuccess()) {
            $cdr = $res->getCdrResponse();
            $util->writeCdr($notaCredito, $res->getCdrZip());
            //actualizar los pagos pendientes

            foreach ($comprobantePago->invoiceDetail as $key => $invoiceDetail) {

                $persona = $comprobantePago->persona;
                $personaArray = $persona->toArray();

                $cantidad = $invoiceDetail->cantidad;

                $ultimo_mes_pago  = MonthLetter::previuosMonth(  $persona->ultimo_mes_pago, $cantidad );
                if ($invoiceDetail->pago->is_primera_cuota == true) {
                    $ultimo_mes_pago = null;
                }
                $subtotal = $cantidad * $persona->precio;
                $numero_meses_aportado  = $persona->numero_meses_aportado  - $subtotal;
                $numero_meses_deuda     = $persona->numero_meses_deuda     + $subtotal;
                $subtotal = $cantidad * $invoiceDetail->precio;

                $total_aportado         = $persona->total_aportado      - $subtotal;
                $multa_pagadas          = $persona->multa_pagadas       - $subtotal;
                $multa_pendiente        = $persona->multa_pendiente     + $subtotal;
                $total_faf              = $persona->total_faf           - 0.25 * $subtotal;
                $total_departamental    = $persona->total_departamental - 0.55 * $subtotal;
                $total_consejo          = $persona->total_consejo       - 0.20 * $subtotal;
                $total_deuda            = $persona->total_deuda         + $subtotal;
                $total_adelanto         = $persona->total_adelanto      - $subtotal;
                $numero_meses_adelanto  = $persona->numero_meses_adelanto      - $cantidad;

                if (isset( $invoiceDetail->pago_id )) {
                    //si el pago es primera cuota

                    if ( $invoiceDetail->concepto->id == Concepto::CUOTA ) {
                        if ($invoiceDetail->pago->is_primera_cuota == true) {
                            $personaArray = array_merge($personaArray , ['is_habilitado' => false]);
                        }
                        //validar si el pago fue un adelanto, en este caso no se deberia restar la deuda, sino solo los aportes
                        if ($invoiceDetail->pago->estado_pago_id == EstadoPago::ADELANTO ) {
                            $personaArray = array_merge($personaArray , ['total_adelanto'    => $total_adelanto]);
                            $personaArray = array_merge($personaArray , ['numero_meses_adelanto'    => $numero_meses_adelanto]);
                        } else {
                            $personaArray = array_merge($personaArray , ['numero_meses_deuda'    => $numero_meses_deuda]);
                            $personaArray = array_merge($personaArray , ['total_deuda' => $total_deuda]);
                        }
                        $personaArray = array_merge($personaArray , ['numero_meses_aportado' => $numero_meses_aportado]);
                        $personaArray = array_merge($personaArray , ['total_aportado' => $total_aportado]);
                        $personaArray = array_merge($personaArray , ['total_faf' => $total_faf]);
                        $personaArray = array_merge($personaArray , ['total_departamental' => $total_departamental]);
                        $personaArray = array_merge($personaArray , ['total_consejo' => $total_consejo]);
                        $personaArray = array_merge($personaArray , ['ultimo_mes_pago'    => $ultimo_mes_pago]);
                        $personaArray = array_merge($personaArray , ['is_pago_cuota_mensual' => 0]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::MULTA ) {
                        $personaArray = array_merge($personaArray , ['multa_pendiente' => $multa_pendiente]);
                        $personaArray = array_merge($personaArray , ['multa_pagadas' => $multa_pagadas]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::MULTAELECCIONES ) {
                        $personaArray = array_merge($personaArray , ['multa_pendiente' => $multa_pendiente]);
                        $personaArray = array_merge($personaArray , ['multa_pagadas' => $multa_pagadas]);
                        $personaArray = array_merge($personaArray , ['is_habilitado' => false]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::INSCRIPCION ) {
                        $personaArray = array_merge($personaArray , ['monto_inscripcion' => 0]);
                        $personaArray = array_merge($personaArray , ['total_deuda' => $total_deuda]);
                        $personaArray = array_merge($personaArray , ['is_pago_colegiatura'=>0]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::CUOTASOLOFAF ) {
                        $personaArray = array_merge($personaArray , ['total_aportado' => $total_aportado]);
                        $personaArray = array_merge($personaArray , ['total_faf' => $subtotal]);
                        $personaArray = array_merge($personaArray , ['numero_meses_aportado' => $numero_meses_aportado]);
                        $personaArray = array_merge($personaArray , ['ultimo_mes_pago'    => $ultimo_mes_pago]);
                        $personaArray = array_merge($personaArray , ['total_adelanto'    => $total_adelanto]);
                        $personaArray = array_merge($personaArray , ['numero_meses_adelanto'    => $numero_meses_adelanto]);
                        $personaArray = array_merge($personaArray , ['is_pago_cuota_mensual' => 1]);
                    }

                    //total_deuda se debe regresar como estaba siempre y cunado no ha sido un adelanto
                    if ( $invoiceDetail->pago->estado_pago_id == EstadoPago::ADELANTO ) {
                        $estadoPago = EstadoPago::ELIMINADO;
                    } else {
                        $estadoPago = EstadoPago::PENDIENTE;
                    }
                    $invoiceDetail->pago->update([ 'estado_pago_id' => $estadoPago ]);
                }
                if ( $persona->is_habilitado == true ) {
                    $today = date("Y-m-d");
                    //si no es habil buscar si tiene registros en persona inhabilitada y deudas vencidas
                    $cantidadPagosVencidos = Pago::where('estado_pago_id',EstadoPago::PENDIENTE)
                    ->where('fecha_vencimiento','<', $today )
                    ->where('persona_id',$persona->id)->count();

                    if ($cantidadPagosVencidos > 0 ) {
                        $personaArray = array_merge( $personaArray , ['is_habilitado'=> false]);
                        //actualizar el PersonaInhabilitada
                        $persona->personaInhabilitada()->create([
                            'fecha_inicio' => $today
                        ]);
                    }
                }
                $persona->update($personaArray);
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

        if ( !($comprobantePago->tipo_documento_pago_id == 1 || $comprobantePago->tipo_documento_pago_id == 2) ) {
            return response()->json( "no se puede generar Nota de un comprobante que no es Boleta y/o Factura", 500);
        }
        if ( $comprobantePago->is_nota == 1 ) {
            return response()->json( "El comprobante ya tiene una Nota Generado", 500);
        }
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
        $nota->afectado->update(['is_nota' => 1]);

        $ubigeo = $this->ubigeoRepository->getByDistritoId( $comprobantePago->empresa->ubigeo_id);

        //armar company con helper
        $util = Util::getInstance();

        $util->setCompany( array_merge($comprobantePago->empresa->toArray(), $ubigeo) );
        $util->setClient( $comprobantePago->cliente );
        $notaCredito = $util->setNotaDebito( $comprobantePago );
        $util->setEmpresa($comprobantePago->empresa);

        try {
            $pdf = $util->getPdf($notaCredito);
            $util->writePdf( $notaCredito , $pdf );
        } catch (Exception $e) {
            return var_dump($e);
        }
        // Envio a SUNAT.
        $see = $util->getSee('');
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

        $ubigeo = $this->ubigeoRepository->getByDistritoId( $comprobantePago->empresa->ubigeo_id);

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
            return var_dump($e);
        }
        // Envio a SUNAT.
        $see = $util->getSee('');
        $res = $see->send($invoice);
        $util->writeXml($invoice, $see->getFactory()->getLastXml());
        if ($res->isSuccess()) {
            $cdr = $res->getCdrResponse();
            $util->writeCdr($invoice, $res->getCdrZip());

            foreach ($comprobantePago->invoiceDetail as $key => $invoiceDetail) {

                $persona = $comprobantePago->persona;
                $personaArray = $persona->toArray();

                $mes_cuota = date("m", strtotime( $persona->fecha_inscripcion));
                $anio_cuota = date("Y", strtotime( $persona->fecha_inscripcion));
                $cantidad = $invoiceDetail->cantidad;

                if (isset($persona->ultimo_mes_pago)) {
                    $mes_cuota = MonthLetter::toNumber( $persona->ultimo_mes_pago );
                    $ultimo_mes_pago  = MonthLetter::nextMonth ( $persona->ultimo_mes_pago , $cantidad );
                } else {
                    $ultimo_mes_pago = MonthLetter::toLetter( $mes_cuota );
                }
                $numero_meses_aportado  = $persona->numero_meses_aportado  + $cantidad;
                $numero_meses_deuda     = $persona->numero_meses_deuda     - $cantidad;
                $subtotal = $cantidad * $invoiceDetail->precio ;

                $total_aportado         = $persona->total_aportado      + $subtotal;
                $multa_pagadas          = $persona->multa_pagadas       + $subtotal;
                $multa_pendiente        = $persona->multa_pendiente     - $subtotal;
                $total_faf              = $persona->total_faf           + 0.25 * $subtotal;
                $total_departamental    = $persona->total_departamental + 0.55 * $subtotal;
                $total_consejo          = $persona->total_consejo       + 0.20 * $subtotal;
                $total_deuda            = $persona->total_deuda         - $subtotal;
                $total_adelanto         = $persona->total_adelanto      + $subtotal;
                $numero_meses_adelanto  = $persona->numero_meses_adelanto      + $cantidad;

                if (isset( $invoiceDetail->pago_id )) {//si es un pago de una deuda

                    $invoiceDetail->pago->update([
                        'estado_pago_id' => EstadoPago::COMPLETADA,
                        'monto' => $subtotal
                    ]);
                    if ( $invoiceDetail->concepto_id == Concepto::CUOTA  ) {
                        if ( $invoiceDetail->pago->is_primera_cuota == true && $persona->is_juramentacion_validada == 1 ) {
                            $personaArray = array_merge( $personaArray , ['is_habilitado'=>1]);
                        }
                        //la deuda se ve afectada siempre y cuando no sea un adelanto
                        if ( $invoiceDetail->pago->estado_pago_id !== EstadoPago::ADELANTO ) {
                            $personaArray = array_merge($personaArray , ['total_deuda' => $total_deuda]);
                        }
                        $personaArray = array_merge($personaArray , ['total_aportado' => $total_aportado]);
                        $personaArray = array_merge($personaArray , ['total_faf' => $total_faf]);
                        $personaArray = array_merge($personaArray , ['total_departamental' => $total_departamental]);
                        $personaArray = array_merge($personaArray , ['total_consejo' => $total_consejo]);
                        $personaArray = array_merge($personaArray , ['numero_meses_aportado' => $numero_meses_aportado]);
                        $personaArray = array_merge($personaArray , ['numero_meses_deuda'    => $numero_meses_deuda]);
                        $personaArray = array_merge($personaArray , ['ultimo_mes_pago'       => $ultimo_mes_pago]);
                        $personaArray = array_merge($personaArray , ['is_pago_cuota_mensual' => 1]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::MULTA ) {
                        $personaArray = array_merge($personaArray , ['multa_pendiente' => $multa_pendiente]);
                        $personaArray = array_merge($personaArray , ['multa_pagadas' => $multa_pagadas]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::MULTAELECCIONES ) {
                        $personaArray = array_merge($personaArray , ['multa_pendiente' => $multa_pendiente]);
                        $personaArray = array_merge($personaArray , ['multa_pagadas' => $multa_pagadas]);
                        $personaArray = array_merge($personaArray , ['is_habilitado' => true]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::INSCRIPCION ) {
                        $personaArray = array_merge($personaArray , ['monto_inscripcion' => $subtotal]);
                        $personaArray = array_merge($personaArray , ['total_deuda' => $total_deuda]);
                        $personaArray = array_merge( $personaArray , ['is_pago_colegiatura'=>1]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::CUOTASOLOFAF ) {
                        $personaArray = array_merge($personaArray , ['total_aportado' => $total_aportado]);
                        $personaArray = array_merge($personaArray , ['total_faf' => $subtotal]);
                        $personaArray = array_merge($personaArray , ['numero_meses_aportado' => $numero_meses_aportado]);
                        $personaArray = array_merge($personaArray , ['ultimo_mes_pago'    => $ultimo_mes_pago]);
                        $personaArray = array_merge($personaArray , ['total_adelanto'    => $total_adelanto]);
                        $personaArray = array_merge($personaArray , ['numero_meses_adelanto'    => $numero_meses_adelanto]);
                        $personaArray = array_merge($personaArray , ['is_pago_cuota_mensual' => 1]);
                    }


                } else {//si es un pago adelatado
                    //generar pagos de Adelantos
                    $pagoName = '';
                    for ($i=0; $i < $cantidad; $i++) {
                        $mes_cuota = MonthLetter::nextMonthNumber( (int) $mes_cuota );
                        $pagoName .= ' '.MonthLetter::toLetter( (int) $mes_cuota ).' ';
                    }
                    $pago = $persona->pagos()->create([
                        'name' => $invoiceDetail->concepto->name .' '.$pagoName.' '.$anio_cuota,
                        'departamento_id' => $persona->departamento_colegiado_id,
                        'mes_cuota'  => $mes_cuota ,
                        'anio_cuota' => $anio_cuota ,
                        'monto' => $invoiceDetail->concepto->precio * $cantidad,
                        'fecha_vencimiento' => date("Y-m-d"),
                        'estado_pago_id' => EstadoPago::ADELANTO,
                        'concepto_id' => $invoiceDetail->concepto->id
                    ]);
                    $invoiceDetail->update( [ 'pago_id' => $pago->id ] );
                    //si no tiene pago generado, quiere decir que es un adelanto
                    if ( $invoiceDetail->concepto_id == Concepto::CUOTA  ) {
                        $personaArray = array_merge($personaArray , ['total_aportado' => $total_aportado]);
                        $personaArray = array_merge($personaArray , ['total_faf' => $total_faf]);
                        $personaArray = array_merge($personaArray , ['total_departamental' => $total_departamental]);
                        $personaArray = array_merge($personaArray , ['total_consejo' => $total_consejo]);
                        $personaArray = array_merge($personaArray , ['numero_meses_aportado' => $numero_meses_aportado]);
                        $personaArray = array_merge($personaArray , ['ultimo_mes_pago'    => $ultimo_mes_pago]);
                        $personaArray = array_merge($personaArray , ['total_adelanto'    => $total_adelanto]);
                        $personaArray = array_merge($personaArray , ['numero_meses_adelanto'    => $numero_meses_adelanto]);
                        $personaArray = array_merge($personaArray , ['is_pago_cuota_mensual' => 1]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::INSCRIPCION ) {
                        $personaArray = array_merge( $personaArray , ['is_pago_colegiatura'=>1]);
                    }
                    if ( $invoiceDetail->concepto_id == Concepto::CUOTASOLOFAF ) {
                        $personaArray = array_merge($personaArray , ['total_aportado' => $total_aportado]);
                        $personaArray = array_merge($personaArray , ['total_faf' => $subtotal]);
                        $personaArray = array_merge($personaArray , ['numero_meses_aportado' => $numero_meses_aportado]);
                        $personaArray = array_merge($personaArray , ['ultimo_mes_pago'    => $ultimo_mes_pago]);
                        $personaArray = array_merge($personaArray , ['total_adelanto'    => $total_adelanto]);
                        $personaArray = array_merge($personaArray , ['numero_meses_adelanto'    => $numero_meses_adelanto]);
                        $personaArray = array_merge($personaArray , ['is_pago_cuota_mensual' => 1]);
                    }
                }
                if ($persona->is_habilitado == false) {
                    $today = date("Y-m-d");
                    //si no es habil buscar si tiene registros en persona inhabilitada y deudas vencidas
                    $cantidadPagosVencidos = Pago::where('estado_pago_id',EstadoPago::PENDIENTE)
                    ->where('fecha_vencimiento','<', $today )
                    ->where('persona_id',$persona->id)->count();

                    $registroInhabil = PersonaInhabilitada::where('persona_id',$persona->id)
                    ->whereNull( 'fecha_fin' )->count();
                    if ($cantidadPagosVencidos == 0 && $registroInhabil > 0) {
                        $personaArray = array_merge( $personaArray , ['is_habilitado'=> true]);
                        //actualizar el PersonaInhabilitada
                        PersonaInhabilitada::where('persona_id', $persona->id )
                                          ->whereNull('fecha_fin')
                                          ->update(['fecha_fin' => $today]);
                    }
                }
                $persona->update($personaArray);
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
