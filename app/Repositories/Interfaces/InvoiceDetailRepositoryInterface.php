<?php

namespace App\Repositories\Interfaces;

use App\InvoiceDetail;
use App\Http\Resources\InvoiceDetail\InvoiceDetailCollection;
use App\Http\Resources\InvoiceDetail\InvoiceDetail as InvoiceDetailResource;
use App\Http\Requests\InvoiceDetail as InvoiceDetailRequest;

interface InvoiceDetailRepositoryInterface
{
    public function all($request);
    public function getOne(InvoiceDetail $invoiceDetail);
    public function newOne(InvoiceDetailRequest $request);
    public function updateOne(InvoiceDetailRequest $request, InvoiceDetail $invoiceDetail);
    public function deleteOne(InvoiceDetail $invoiceDetail);
}