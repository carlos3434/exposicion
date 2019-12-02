<?php

namespace App\Repositories\Interfaces;

use App\Invoice;
use App\Http\Resources\Invoice\InvoiceCollection;
use App\Http\Resources\Invoice\Invoice as InvoiceResource;
use App\Http\Requests\Invoice as InvoiceRequest;

interface InvoiceRepositoryInterface
{
    public function all($request);
    public function allForExcel($request);
    public function getOne(Invoice $invoice);
    public function newOne(InvoiceRequest $request);
    public function updateOne(InvoiceRequest $request, Invoice $invoice);
    public function deleteOne(Invoice $invoice);

    public function getResourceById($invoiceId);
    public function getById($invoiceId);
    public function envioSunat($invoiceId);
    public function getLastNumeroInvoiceBySerie($serieId , $tipoDocumentoPagoId);
    public function getEstadoInvoice(Invoice $invoice);
}