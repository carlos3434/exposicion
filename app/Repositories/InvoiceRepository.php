<?php
namespace App\Repositories;

use App\Invoice;
use App\Http\Resources\Invoice\InvoiceCollection;
use App\Http\Resources\Invoice\Invoice as InvoiceResource;
use App\Http\Requests\Invoice as InvoiceRequest;
use Greenter\Model\DocumentInterface;
use DB;

use App\Repositories\Interfaces\InvoiceRepositoryInterface;
/**
 * 
 */
class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function all($request)
    {
        return new InvoiceCollection(
            Invoice::filter($request)->sort()->paginate()
        );
    }
    public function allForExcel($request)
    {
        return new InvoiceCollection(
            Invoice::filter($request)->get()
        );
    }
    public function getOne(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }
    public function newOne( $invoice)
    {
        //search client with dni or ruc
        $invoice = Invoice::create($invoice);
        return $invoice->id;
    }
    public function updateOne(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update( $request->all() );
        return $invoice;
    }
    public function deleteOne(Invoice $invoice)
    {
        $invoice->delete();
    }
    public function getResourceById($invoiceId)
    {
        return new InvoiceResource(Invoice::find($invoiceId));
        //
    }
    public function getById($invoiceId)
    {
        return Invoice::find($invoiceId);
        //
    }
    public function updatePaths($comprobantePago , DocumentInterface $invoice)
    {
        $comprobantePago = Invoice::find($comprobantePago->id);
        $comprobantePago->xml_path = $invoice->getName().'.xml';
        $comprobantePago->pdf_path = $invoice->getName().'.pdf';
        $comprobantePago->cdr_path = 'R-'.$invoice->getName().'.zip';
        $comprobantePago->save();
        return $comprobantePago;
    }
    public function envioSunat($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        //
    }
    public function getLastNumeroInvoiceBySerie($serieId , $tipoDocumentoPagoId)
    {
        $numero = Invoice::where('serie_id', $serieId)
        ->where('tipo_documento_pago_id', $tipoDocumentoPagoId)
        ->max(DB::raw('numero + 0'));
        return $numero+1;
    }
    public function getEstadoInvoice(Invoice $invoice)
    {
        return ($invoice->cdr_path!='')? true : false;
    }
}